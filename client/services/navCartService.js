/**
 * Define a service that keeps the cart quantity in the navbar updated
 * This is essential because the controller that manages the navbar and 
 * the controller that manages the rest of the home page are distinct 
 * and there is no straightforward way to share information between 
 * those controllers outside of a service. This service exploits the 
 * AngularJS lifecycle events to bind data in the
 * navbar (in one controller: NavController) to changes in a service modified by 
 * another controller (HomeController). 
 * 
 */
angular.module('phoMart')
.factory('NavCartService', function($rootScope) {
    return {
        subscribe: function(scope, callback) {
        		/** The $on method listens to events of a given type ('navcart-service-event')
        		and applies a callback when the event subscribed to occurs - in this application
        		the NavController subscribes to the given event which is triggered by the HomeController
        		which executes the notify() function which essentially broadcasts to all concerned listeners
        		that an event of the given type has occurred. */
            var handler = $rootScope.$on('navcart-service-event', callback);
            /** The $on method listens on events of a given type, in this case '$destroy' which
            is used to remove a scope from the scope hierarchy
            events.  */
            scope.$on('$destroy', handler);
        },

        notify: function() {
        		/**
        		 * $emit dispatches an event of a given type(here: 'navcart-service-event')
        		 * up through the scope hierarchy notifying the registered $rootScope.Scope
        		 * listeners
        		 */
            $rootScope.$emit('navcart-service-event');
        }
    };
});