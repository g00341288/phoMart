/**
 * angular.module is a global place for creating, registering and retrieving Angular modules
 * 'starter' is the name of this angular module (also set in the <body> attribute in index.html)
 * the 2nd parameter is an array of 'requires', including ionic, and [TODO]
 * 
 * Dependencies include: 
 *   ionic              (for Ionic, Angular and other related dependencies)
 */
angular.module('phoMart', ['ionic', 'phoMart.services'])


.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})
