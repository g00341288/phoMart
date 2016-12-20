/**
 * Define a controller to manage the home view (home.php)
 */
angular.module('phoMart.controllers')
	.controller('NavController', function($scope, $rootScope, CART_META, ProductService, SessionService){
		console.log('NavController triggered');

		/** @type {string} Retrieve the session id via an AJAX call from SessionService */
		var sessionId = SessionService.retrieveSessionId('PHPSESSID');

		/** @type {object} Make a local copy of the CART_META service object */
		var cartMeta = CART_META;

		/** Iterate over localStorage and count the number of items in the cart associated
		with this session */
		for(var key in localStorage){
				
			if(key.match(sessionId)){

				cartMeta.data.itemQty++; 

			}
		}

		/**
		 * Add a representation of the cart metadata on the scope to facilitate 
		 * binding in the view (specifically, the go to cart button) - note that
		 * this only updates if you navigate away and back to the products page
		 * within a session [TODO - revise this?]
		 * @type {object}
		 */
		$scope.cart = {
			quantity: cartMeta.data.itemQty
		};

	});