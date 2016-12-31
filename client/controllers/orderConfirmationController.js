/**
 * Define a controller to manage the orderConfirmation view (orderConfirmation.php)
 */
angular.module('phoMart.controllers')
	.controller('OrderConfirmationController', function($scope, NavCartService, DBService, SessionService, UtilityService){
		console.log('OrderConfirmationController triggered!');


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
