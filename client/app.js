/**
 * angular.module is a global place for creating, registering and retrieving Angular modules
 * 'phoMart' is the name of this angular module (also set as a div attribute in home.php)
 * the 2nd parameter is an array of 'requires', including the services, controllers, and 
 * third party submodules
 * 
 * Dependencies include: 
 * 
 *   phoMart.services         Angular services for db transactions, AJAX requests, utilities and local storage operations
 *   phoMart.controllers			Angular controllers for client application
 *   ngCookies								Angular module providing a convenient wrapper for reading/writing browser cookies							
 *   angularPayments					Angular module providing directives for formatting and validating payment forms (credit cards etc)
 *   
 */
angular.module('phoMart', ['phoMart.services', 'phoMart.controllers', 'ngCookies', 'angularPayments']);
