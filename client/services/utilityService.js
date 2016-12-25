/** 
 * A service which exposes an API with methods for working with session data
 */
function utilityService($http){

  function contains(value, array) {
    return array.indexOf(value) > -1;
  }

  /**
   * Using the revealing module pattern expose a simple API with methods for 
   * working on various problems in the application solution domain, including
   * checking if an array contains a value [TODO elaborate as needed]
   * 
   * This object will be available elsewhere in the application by this name: 
   *
   * UtilityService
   * 
   * and the relevant methods will be called as follows:
   * 
   * UtilityService.contains(value, array)
   *
   */
  return {
    contains: contains
  }
}

/** Register UtilityService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('UtilityService', utilityService);