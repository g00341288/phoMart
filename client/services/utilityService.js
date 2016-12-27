/** 
 * A service which exposes an API with methods for working with session data
 */
function utilityService($http){

  function contains(value, array) {
    return array.indexOf(value) > -1;
  }

  function getSessionId(){
    return document.cookie.match(/PHPSESSID=[^;]+/)[0].split("=")[1]; 
  }

  function each(match, collection, callback, params){
    var output = []; 

    /** Iterate over collection - and execute the callback against the matching 
    items given match (string) and params (any)*/
    for(var key in collection){
      
      if(key.match(match)){
        output.push(callback(match, params)); 
      }

    }
    return output;
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
    contains: contains,
    each: each, 
    getSessionId: getSessionId
  }
}

/** Register UtilityService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('UtilityService', utilityService);