/**
 * angular.module is a global place for creating, registering and retrieving Angular modules
 * 'phoMart' is the name of this angular module (also set as a div attribute in home.php)
 * the 2nd parameter is an array of 'requires', including the services submodule
 * 
 * Dependencies include: 
 *   services              (for db transactions and local storage operations)
 */
angular.module('phoMart', ['phoMart.services', 'phoMart.controllers', 'ngCookies'])
.value('CART_META', {data: { itemQty: 0 }});
