/**
 * Define a controller to manage the payment view (payment.php)
 */
angular.module('phoMart.controllers')
	.controller('PaymentFormController', function($scope, NavCartService, DBService, SessionService){

		/**
		 * @type {object}	Bind model to view (payment form) and set defaults
		 */
		$scope.payment = {
			firstname: "Firstname",
			surname: "Surname",
			creditCardNumber: "4485558974684386",
			creditCardCVV: "393",
			creditCardExpiry: "07/2017",
			addressLine1: "Address Line 1",
			addressLine2: "Address Line 2",
			addressLine3: "Address Line 3",
			city: "City",
			county: "County",
			zip: "Zip",
			telephone: "Telephone",
			mobile: "Mobile"
		}
	});
