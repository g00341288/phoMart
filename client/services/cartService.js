
angular.module('phoMart')
.factory('CartService', function($rootScope) {
    return {
        subscribe: function(scope, callback) {
        		/** The $on method listens to events of a given type ('cart-service-event')
        		and applies a callback when the event subscribed to occurs - in this application
        		the CartController subscribes to the given event which is also triggered by the CartController,
                specifically an event associated with the remove button in the view and the corresponding 
                method in the controller.  */
            var handler = $rootScope.$on('cart-service-event', callback);
            /** The $on method listens on events of a given type, in this case '$destroy' which
            is used to remove a scope from the scope hierarchy
            events.  */
            scope.$on('$destroy', handler);
        },

        notify: function() {
        		/**
        		 * $emit dispatches an event of a given type(here: 'cart-service-event')
        		 * up through the scope hierarchy notifying the registered $rootScope.Scope
        		 * listeners
        		 */
            $rootScope.$emit('cart-service-event');
        }
    };
});