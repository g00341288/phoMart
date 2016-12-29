/**
 * angular.module is a global place for creating, registering and retrieving Angular modules
 * 'phoMart' is the name of this angular module (also set as a div attribute in home.php)
 * the 2nd parameter is an array of 'requires', including the services, controllers, and 
 * directives submodules
 * 
 * Dependencies include: 
 *   phoMart.services         (for db transactions, AJAX requests and local storage operations)
 *   phoMart.controllers			(application controllers)
 *   angular-cookies					(Angular module providing a convenient wrapper for reading/writing browser cookies)							
 */
angular.module('phoMart', ['phoMart.services', 'phoMart.controllers', 'ngCookies']);
