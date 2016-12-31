/**
 * Define a controller to manage the home view (home.php)
 */
angular.module('phoMart.controllers')
	.controller('HomeController', function($scope, $sce, NavCartService, DBService, SessionService){

		/**------------------------------------------- UI Setup  ------------------------------------ */
		

		/** @type {object} Angular UI Bootstrap Popover content */
		$scope.dynamicPopover = {
			title: 'Search',
			content: 'Currently unavailable!'
			 
		};

		$scope.revealed = false; 

		$scope.reveal = function(){
			$scope.revealed = !$scope.revealed;
		};

		/** Notify all subscribers that a NavCartService event has occurred */
		$scope.notify = function(){
			NavCartService.notify();
		}; 

		/** @type {array} Make an array available to the $scope to hold products for 
		consumption by the view */
		$scope.products = []; 

		/** Call the DBService retrieve() method to retrieve data from the product table of the application database 
		  * The form of this rather convoluted bit of code is as follows: 
		  * 
		  * 	DBService.retrieve(baseUrl, params).then(success, failure); 
		  * 	
		  * See client/services/DBService.js for more detail
		  */
		DBService.retrieve('../server/db/retrieveProducts.php?', { params: { table: 'product'}}).then(
			/**
			 * Success callback for the DBService.retrieve AJAX call to the MySQL DB product table
			 * @param  {object} res Response object from AJAX call to PHP server
			 */
			function(res){
				/** @type {array} Add an array of products retrieved from the DB, to the $scope */
				$scope.products = res.data;
				console.log($scope.products);
			},
			/**
			 * Failure callback for the DBService.retrieve AJAX call to the MySQL DB product table
			 * @param  {object} res Response object from AJAX call to PHP server
			 */ 
			function(res){
				console.log('Something has gone wrong!');
				console.error(res);
			});

		$scope.addToCart = function(product){

			/** @type {string} Get the PHP session id for this user */
			var sessionId = SessionService.retrieveSessionId('PHPSESSID');

			product.cart_id = sessionId + "_" + localStorage.length; 
			
			/** and store the current product in localStorage */
			localStorage.setItem(sessionId + "_" + localStorage.length, JSON.stringify(product));

			/** Broadcast to all subscribers that an item has been added to the cart - currently, 
			the only subscriber is the NavController which will update the navbar cart quantity
			when it is notified of the given event! */
			$scope.notify();
			
		
		};
			
	});