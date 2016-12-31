/**
 * Define a controller to manage the orderConfirmation view (orderConfirmation.php)
 */
angular.module('phoMart.controllers')
	.controller('OrderConfirmationController', function($scope, NavCartService, DBService, SessionService, UtilityService){
		console.log('OrderConfirmationController triggered!');


		/**------------------------------------------- UI Setup  ------------------------------------ */
		

		/** @type {object} Angular UI Bootstrap Popover content */
		$scope.dynamicPopover = {
			title: 'Search',
			content: 'Still unavailable!'
			 
		};

		$scope.revealed = true; 

		$scope.reveal = function(){
			$scope.revealed = !$scope.revealed;
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

		
		/** @type {object} Get and store the phoMartOrderSummary data from localStorage  */
		var orderRefsObj = UtilityService.each('phoMartOrderSummary', localStorage, UtilityService.parse)[0].data;

		/** @type {object} Extract the reference ids and make available on the $scope of the controller */
		$scope.referenceIds = {
			order_id: orderRefsObj._order_id,
			invoice_id: orderRefsObj.invoice_id,
			payment_id: orderRefsObj.payment_id, 
			delivery_id: orderRefsObj.delivery_id
		}; 

		/** @type {string} Construct a unique order reference id by concatenating the order, invoice, payment and
		delivery ids retrieved from the phoMartOrderSummary data in localStorage and make it available on the 
		$scope of the controller for consumption in the view */
		$scope.orderReferenceNumber = $scope.referenceIds.order_id 
		+ "-" 
		+ $scope.referenceIds.invoice_id 
		+ "-" 
		+ $scope.referenceIds.payment_id 
		+ "-"
		+ $scope.referenceIds.delivery_id; 
		

	});
