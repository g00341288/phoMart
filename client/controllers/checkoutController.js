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

		/** Open an order record in the database and proceed to the payment page */
		$scope.proceed = function(){
			/** Call the DBService retrieve() method to retrieve data from the product table of the application database */
		DBService.create('../server/db/queryDB.php?', 
			{
				params: {
					table: '_order',
					user_id: $scope.order.user_id,
					reference_id: $scope.order.reference_id,
					complete: 'false'
				}
			}).then(function(res){console.log(res); console.log('How does it look?')}, 
			function(res){console.log(res); console.log('Error?');});
		};
		

	});