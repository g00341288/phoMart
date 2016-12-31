/**
 * Define a controller to manage the payment view (payment.php)
 */
angular.module('phoMart.controllers')
	.controller('PaymentFormController', function($scope, NavCartService, DBService, SessionService, UtilityService){

	

	/**------------------------------------------- Controller initialisation ------------------------------------ */




		/** @type {string}	Get and store the current session id using a method exposed by the SessionService  */
		var sessionId = SessionService.retrieveSessionId();

		/** @type {object} Retrieve order information object from localStorage  */
		var phoMartOrder = UtilityService.each("phoMartOrder", localStorage, UtilityService.parse)[0];




	/**------------------------------------------- Set up bindings on the $scope -------------------------------- */


		

		/**
		 * @type {object}	Bind model to view (payment form), set defaults some of which are retrieved from 
		 * order-relevant data stored in localStorage during previous steps
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




	/**------------------------------------------- Set up view button behaviour -------------------------------- */




		/** When submit button is clicked by user, the application closes out the current order. Closing
		an order involves several key steps: (i) update the user table with associated payment and delivery
		related details and set sensible defaults; (ii) create a new payment record; (iii) create a new 
		delivery record; and (iv) remove cart items from localStorage before storing some information to 
		localStorage to feed back to the user on the order confirmation page */
		$scope.submit = function(){

			
			/** @type {obect} Update user payment details in user table with AJAX request exposed
			by DBService*/
			DBService.update('../server/db/updateUserPaymentDetails.php?', 
				{
					params: {
						table: 'user',
						user_id: $scope.payment.user_id,
						cc_number: $scope.payment.creditCardNumber,
						cc_cvv: $scope.payment.creditCardCVV,
						cc_expiry: UtilityService.convertExpiry($scope.payment.creditCardExpiry)
					}
				}).then(function(res){
					/**
					 * Close order: call AJAX service method to post to the server to be used on the server 
					 * side to update the user table with payment details, create a new payment record,
					 * and a new delivery record. The server will return data for use in the order 
					 * confirmation page.   
					 * @param  {object} res Response object from server
					 */
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

							/** Finally store an object in localStorage containing data for order summary/confirmation... */
							localStorage.setItem('phoMartOrderSummary', JSON.stringify(res));

							/** ... and navigate to the order confirmation page */
							window.location.href="orderConfirmation.php";

						}, function(res){
							console.error(res); 
						});
					}, function(res){
						console.error(res);
					}); 


		}; 

	});
