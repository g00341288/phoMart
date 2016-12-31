/**
 * Define a controller to manage the payment view (payment.php)
 */
angular.module('phoMart.controllers')
	.controller('PaymentFormController', function($scope, NavCartService, DBService, SessionService, UtilityService){

		var sessionId = SessionService.retrieveSessionId();

		var phoMartOrder = UtilityService.each("phoMartOrder", localStorage, UtilityService.parse)[0];
		/**
		 * @type {object}	Bind model to view (payment form), set defaults and collect order-relevant
		 * data from localStorage
		 */
		$scope.payment = {
			
			addressLine1: "Address Line 1",
			addressLine2: "Address Line 2",
			addressLine3: "Address Line 3",
			authorised: true,
			city: "City",
			complete: true,
			county: "County",
			creditCardCVV: "393",
			creditCardExpiry: "07/2017",
			creditCardNumber: "4485558974684386",
			firstname: "Firstname",
			invoice_id: parseInt(phoMartOrder.invoice_id),
			mobile: "Mobile",
			_order_id: parseInt(phoMartOrder.order_id),
			payment_method: "credit card",
			reference_id: phoMartOrder.reference_id,
			surname: "Surname",
			telephone: "0214815070",
			total: phoMartOrder.total,
			user_id: phoMartOrder.user_id,
			zip: "Zip"

		}; 

		$scope.submit = function(){

			/**
			 * Close order: 
			 * @param  {[type]} res [description]
			 * @return {[type]}     [description]
			 */
			function success(res){
				DBService.create('../server/db/closeOrder.php', 
				{
					params: {
						table: 'payment',
						invoice_id: $scope.payment.invoice_id,
						_order_id: $scope.payment._order_id,
						amount: $scope.payment.total,
						payment_method: $scope.payment.payment_method,
						authorised: $scope.payment.authorised, 
						delivery_firstname: $scope.payment.firstname,
						delivery_surname: $scope.payment.surname,
						addr_line1: $scope.payment.addressLine1,
						addr_line2: $scope.payment.addressLine2,
						addr_line3: $scope.payment.addressLine3,
						city: $scope.payment.city,
						cnty: $scope.payment.county,
						zip: $scope.payment.zip,
						tel: $scope.payment.telephone,
						mobile: $scope.payment.mobile
					}
				}).then(function(res){
					/** If the response indicates that the transaction has been committed, 
					delete the corresponding records in localStorage.  */
					if(res.data.transaction == "committed"){
						angular.forEach(localStorage, function(value, key){
							localStorage.removeItem(key);
						});
					}

					/** Finally store an object in localStorage containing key data for order summary/confirmation */
					localStorage.setItem('phoMartOrderSummary', JSON.stringify(res));

				}, function(res){console.log(res); });
			}

			function failure(res){
				console.log(res);
			}

			/** @type {obect} Update user payment details in user table with AJAX request */
			DBService.update('../server/db/updateUserPaymentDetails.php?', 
				{
					params: {
						table: 'user',
						user_id: $scope.payment.user_id,
						cc_number: $scope.payment.creditCardNumber,
						cc_cvv: $scope.payment.creditCardCVV,
						cc_expiry: UtilityService.convertExpiry($scope.payment.creditCardExpiry)
					}
				}).then(success, failure); 


		}; 

	});
