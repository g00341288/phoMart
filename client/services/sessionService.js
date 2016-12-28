/** 
 * A service which exposes an API with methods for working with session data
 */
function phoMartSessionService($http, $cookies){

  /**
   * Retrieve the PHP session id from cookies
   * @param  {string}   match  cookie identifier for PHP Session ID
   * @return {string}          PHP Session id as a string (retrieved from cookie)
   */
  function retrieveSessionId(match) {
    return $cookies.get(match); 
  }

  /**
   * Using the revealing module pattern expose a simple API with methods for working
   * with session data
   * 
   * This object will be available elsewhere in the application by this name: 
   *
   * SessionService
   * 
   * and the relevant methods will be called as follows:
   * 
   * SessionService.retrieveSessionId(match)
   *
   */
  return {
    retrieveSessionId: retrieveSessionId
  }
}

/** Register SessionService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('SessionService', phoMartSessionService);