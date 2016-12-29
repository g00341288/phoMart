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
			vatRate: 0.23
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

		/** Calculate the total plus vat for this order */
		$scope.getTotalPlusVat = function(total, vatRate){
			var total = total + (total*vatRate);
			$scope.order.total = total;
			return total;
		};

		/** Go back to cart page */
		$scope.back = function(){
			window.location.href = 'cart.php';
		}; 

		/** Open an order in the database and proceed to the payment page */
		$scope.proceed = function(){

			/** @type {array} iterate over the cart items stored on the $scope of the current
			controller and retrieve the product id from each */
			var productIds = []; 

			/** Iterate over the items array and extract the product ids for further processing 
			at the server side */
			for(var item in $scope.order.items){
				productIds.push(parseInt($scope.order.items[item].product_id));
			}

			/** @type {string} Encode the array as a string - this will be picked up by PHP on the other side
			and decoded for use in executing SQL transactions */
			var jsonedProductIds = JSON.stringify(productIds);

			/** Call the DBService create() method to open an order. To 'open' an order consists in two principal CRUD
			operations bundled up in a MySQL transaction: (i) create a record in the _order table of the db with the 
			user_id, reference_id, and complete flag; (ii) create a record in the _order_product table for
			each order product. The complete flag is set to false while the order is in progress and later set to 
			true when payment and delivery records have been successfully created.  */
			DBService.create('../server/db/openOrder.php?', 
				{
					params: {
						table: '_order',
						items: jsonedProductIds,
						user_id: $scope.order.user_id,
						reference_id: $scope.order.reference_id,
						complete: 'false'
					}
				}).then(function(res){
					// do a check to see that an order has been opened - another AJAX call?
					console.log(res); 
					console.log('How does it look?')
				}, 
				function(res){
					console.log(res); 
					console.log('Error?');});
			};
		

	});