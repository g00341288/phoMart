/**
 * Define a controller to manage the checkout view (checkout.php)
 */
angular.module('phoMart.controllers')
	.controller('CheckoutController', function($scope, $rootScope, SessionService, UtilityService){

		console.log('CheckoutController triggered');

		$scope.meta = {
			date: UtilityService.getDate()
		};

		$scope.order = {
			items: [], 
			dataUserId: "",
			sessionId: ""
		};

		/** @type {string} Retrieve the session id via an AJAX call from SessionService */
		var sessionId = SessionService.retrieveSessionId('PHPSESSID');


	});