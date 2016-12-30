/**
 * Define a controller to manage the payment view (payment.php)
 */
angular.module('phoMart.controllers')
	.controller('PaymentFormController', function($scope, NavCartService, DBService, SessionService){

		$scope.payment = {
			firstname: "Firstname",
			surname: "Surname",
			creditCardNumber: "Credit Card Number",
			creditCardCVV: "Credit Card CVV",
			creditCardExpiry: "Credit Card Expiry Date",
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
