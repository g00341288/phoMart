/**
 * Define a controller to manage the home view (home.php)
 */
angular.module('phoMart.controllers')
	.controller('CartController', function($scope, $rootScope, CART_META, ProductService, SessionService){
		console.log('CartController triggered');

		/** @type {string} Retrieve the session id via an AJAX call from SessionService */
		var sessionId = SessionService.retrieveSessionId('PHPSESSID');

		/** @type {object} Make a local copy of the CART_META service object */
		var cartMeta = CART_META;

		$scope.cart = [];

		/** Iterate over localStorage and count the number of items in the cart associated
		with this session */
		for(var key in localStorage){
				
			if(key.match(sessionId)){

				$scope.cart.push(JSON.parse(localStorage.getItem(key)));

			}
		}

	});