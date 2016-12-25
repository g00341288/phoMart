/**
 * Define a controller to manage the home view (home.php)
 */
angular.module('phoMart.controllers')
	.controller('NavController', function($scope, $rootScope, ProductService, 
		SessionService, NavCartService){

		console.log('NavController triggered');

		/** @type {string} Retrieve the session id via an AJAX call from SessionService */
		var sessionId = SessionService.retrieveSessionId('PHPSESSID');

		/**
		 * Add a representation of the cart metadata on the scope to facilitate 
		 * binding in the view (specifically, the go to cart button). This is updated
		 * using the publish/subscribe model and implemented using AngularJS $on and 
		 * $emit functions on the $rootScope - see client/services/navCartService.js
		 * for more information, below (NavCartService.subscribe())
		 */
		$scope.cart = {
			quantity: 0
		};

		/**
		 * Check localStorage when the controller fires to determine the number of items
		 * in the cart
		 */
		for(var key in localStorage){
			if(key.match(sessionId)){
				$scope.cart.quantity++;
			}
		}

		/** Subscribe to the NavCartService to listen for events in the HomeController that
		affect the cart quantity displayed in the navbar - increment the cart analogue in the
		current scope to ensure the nav view keeps pace with the view content the HomeController
		is responsible for */
		NavCartService.subscribe($scope, function somethingChanged(){
			$scope.cart.quantity++;
		});

	});