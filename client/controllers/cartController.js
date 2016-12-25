/**
 * Define a controller to manage the home view (home.php)
 */
angular.module('phoMart.controllers')
	.controller('CartController', function($scope, $rootScope, CartService, ProductService, 
		SessionService, UtilityService){
		console.log('CartController triggered'); 

		$scope.order = {
			total: calculateTotal()
		};

		/** Notify all subscribers that a NavCartService event has occurred */
		$scope.notify = function(){
			CartService.notify();
		}; 

		/** Subscribe to the CartService to listen for events that update the cart total
		*/
		CartService.subscribe($scope, function anItemRemoved(){
			$scope.order.total = calculateTotal();
		});
		
		/** @type {string} Retrieve the session id via an AJAX call from SessionService */
		var sessionId = SessionService.retrieveSessionId('PHPSESSID');

		$scope.cart = [];

		function populateCart(){

			var product; 

			/** @type {string} Retrieve the session id via an AJAX call from SessionService */
			var sessionId = SessionService.retrieveSessionId('PHPSESSID');

			/** Iterate over localStorage and get all products, pushing each to the cart array 
			now available on the scope */
			for(var key in localStorage){
					
				/** providing they key contains a substring that matches the session id */
				if(key.match(sessionId)){

					product = JSON.parse(localStorage.getItem(key));

					$scope.cart.push(product);

				}

			}

		}

		populateCart();

		function calculateTotal(){
			var total = 0.0;

			/** Iterate over localStorage - and sum the prices of the chosen products provided the 
			items in localStorage have a key that contains the sessionId belonging to the current
			session */
			for(var key in localStorage){
				
				if(key.match(sessionId)){
					var price =  parseFloat(JSON.parse(localStorage.getItem(key)).price); 
					total += price;
				}

			}
			return total;
		}

		
		$scope.remove = function(product, index){ 

			/** Iterate over localStorage and get all products, pushing each to the cart array 
			now available on the scope */
			for(var key in localStorage){
					
				/** providing they key contains a substring that matches the session id */
				if(key.match(sessionId)){
					
					console.log(key);
					console.log(product.cart_id)
					if(product.cart_id == key) {
						/** Remove the item from localStorage */
						localStorage.removeItem(key);
					} 
				}

			}
			$scope.cart.splice(index, 1); 
			$scope.notify();

		}; 

		/** get a reference to the table element in the DOM in vanilla JavaScript */
		// var table = document.getElementsByTagName('table')[0];

		/** Add an event listener to handle the click event on any table row */
		// table.addEventListener('click', removeItem, true);


	});

