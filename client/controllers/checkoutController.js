/**
 * Define a controller to manage the checkout view (checkout.php)
 */
angular.module('phoMart.controllers')
	.controller('CheckoutController', function($scope, $rootScope, DBService, SessionService, UtilityService){

		console.log('CheckoutController triggered');

			/** @type {string} Retrieve the session id via AngularJS $cookies from SessionService */
		var sessionId = SessionService.retrieveSessionId('PHPSESSID');

		$scope.order = {
			items: [], 
			user_id: "",
			reference_id: sessionId, 
			total: 0.00,
			vatRate: 0.23, 
			vat: 0.00
		};

		/** @type {array} Get the items from localStorage using the UtilityService each() method */
		$scope.order.items = UtilityService.each(sessionId, localStorage, UtilityService.parse);

		/** Given an index supplied by ng-repeat in the view, calculate the running total */
		$scope.getRunningTotal = function(index){ 
			var total = 0.00; 
			angular.forEach($scope.order.items, function(value,key){
				if(key <= index){
					total += parseFloat(value.price);
				}
			});
			$scope.order.total = total;
			return total;
		};

		/** Calculate the total plus vat for this order and set the total, subtotal, and vat properties 
		on the order object on the $scope of the controller */
		$scope.getTotalPlusVat = function(subTotal, vatRate){
			var total = subTotal + (subTotal * vatRate);
			$scope.order.subtotal = subTotal;
			$scope.order.vat = (subTotal * vatRate);
			$scope.order.total = total;
			return total;
		};

		/** Go back to cart page */
		$scope.back = function(){
			window.location.href = 'cart.php';
		}; 

		/** Open an order in the database and proceed to the payment page */
		$scope.proceed = function(){

			/** @type {array} Declare and initialise an array to store product ids retrieved from 
			the current cart */
			var productIds = []; 

			/** Iterate over the items array on the $scope and extract the product ids for further processing 
			at the server side */
			for(var item in $scope.order.items){
				productIds.push(parseInt($scope.order.items[item].product_id));
			}

			/** @type {string} Encode the array as a string - this will be picked up by PHP on the other side
			and decoded for use in executing SQL transactions */
			var jsonedProductIds = JSON.stringify(productIds);

			/** Call the DBService create() method to open an order. To 'open' an order consists in three principal CRUD
			operations bundled up in a MySQL transaction: (i) create a record in the _order table of the db with the 
			user_id, reference_id, and complete flag; (ii) create a record in the _order_product table for
			each order product; and (iii) create an invoice record in the invoice table. The complete flag on the _order
			table is set to false while the order is in progress and later set to true when payment and delivery records 
			have been successfully created. On success, this method sets up a simple payment object in localStorage which
			the payment view will use to facilitate the queries against the db necessary to set up payment and delivery
			records. */
			DBService.create('../server/db/openOrder.php?', 
				{
					params: {
						table: '_order',
						items: jsonedProductIds,
						user_id: $scope.order.user_id,
						reference_id: $scope.order.reference_id,
						complete: 'false', 
						subtotal: $scope.order.subtotal,
						total: $scope.order.total, 
						vat: $scope.order.vat
					}
				}).then(function(res){

					console.log(res); 	

					var phoMartPaymentObject = {
						user_id: $scope.order.user_id, 
						order_id: res.data._order_id,
						invoice_id: res.data.invoice_id,
						reference_id: $scope.order.reference_id, 
						total: $scope.order.total, 
						complete: 'false'
					}; 

					/** Store payment-relevant data in localStorage for use in payment view */
					localStorage.setItem('phoMartPayment'+localStorage.length, JSON.stringify(phoMartPaymentObject)); 

					/** Redirect to payment page */
					window.location.href="payment.php";
				}, 
				function(res){
					console.log(res); 
					console.log('Error?');});
			};

			

	});