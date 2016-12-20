/**
 * Define a controller to manage the home view (home.php)
 */
angular.module('phoMart.controllers')
	.controller('HomeController', function($scope, $rootScope, ProductService, SessionService){

		console.log('HomeController triggered');

		/** @type {array} Make an array available to the $scope to hold products for 
		consumption by the view */
		$scope.products = []; 

		/**
		 * Success callback for the ProductService.retrieve AJAX call
		 * to the MySQL DB product table
		 * @param  {object} res Response object from AJAX call to PHP server
		 */
		function success(res){
			/** @type {array} An array of products retrieved from the DB */
			$scope.products = res.data;
			
		}

		/**
		 * Failure callback for the ProductService.retrieve AJAX call
		 * to the MySQL DB product table
		 * @param  {object} res Response object from AJAX call to PHP server
		 */
		function failure(res){
			console.log('Something has gone wrong!');
			console.error(res);
		}

		/** Call the ProductService retrieve() method to retrieve data from the 
		product table of the application database */
		ProductService.retrieve('../server/db/getProductData.php').then(success, failure);

		$scope.addToCart = function(product){

			/** @type {string} Get the PHP session id for this user */
			var sessionId = SessionService.retrieveSessionId('PHPSESSID');

			
			/** Store the new cart item in localStorage, using a combination of session id and 
			storage length to construct a unique key for the resulting key/value pair */
			localStorage.setItem(sessionId + "_" + localStorage.length, JSON.stringify(product));
		}; 

	});