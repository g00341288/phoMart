/**
 * Create and register the services submodule of the phoMart module.
 * Submodule services are defined in the following files (relative to phoMart
 * directory): 
 *
 * client/services/dbService.js
 * client/services/navCartService.js
 * client/services/sessionService.js
 * client/services/utilityService.js
 * 
 * angular.module is used to create, register and retrieve application 
 * modules in an Angular application - all modules are registered with 
 * angular.module. The latter takes two parameters, the second optional. 
 * If the second parameter is omitted, an existing module is retrieved 
 * (getter). If it is provided, a new module is created and registered 
 * (setter). 
 */
angular.module('phoMart.services', []);