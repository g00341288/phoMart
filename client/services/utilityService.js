/** 
 * A service which exposes an API for various useful utilities
 */
function utilityService($http){

  /**
   * Given a credit card expiry date, convert it for use by 
   * PHP server in generating a date type entry to insert
   * in MySQL table
   * @param  {string} expiry A string representing credit card expiry date
   * @return {string}        A string representation of the card expiry date for consumption
   *                         by PHP server in constructing a date type MySQL db entry
   */
  function convertExpiry(expiry){
    var month = expiry.split("/")[0];
    var year = expiry.split("/")[1];
    var day = "01";
    expiry = new Date(month+"/"+day+"/"+year);
    month = expiry.getMonth()+1;
    year = expiry.getFullYear();
    day = expiry.getDate();
    expiry = day + "/" + month + "/" + year; 
    return expiry;
  }

  /**
   * Parse the given item as JSON
   * @param  {string} item String representation of JSON
   * @return {object}      JavaScript object corresponding to given item
   */
  function parse(item) {
    return JSON.parse(item);
  }

  /**
   * Check if a given value occurs in a given array
   * @param  {*}        value      A 'primitive' value
   * @param  {array}    array      An array of such values
   * @return {boolean}             True if the array contains the value, false otherwise
   */ 
  function contains(value, array) {
    return array.indexOf(value) > -1;
  }

  /**
   * Get the current session id from cookies the vanilla JS way
   * @return {string} Current session ID retrieved from cookies
   */
  function getSessionId(){
    return document.cookie.match(/PHPSESSID=[^;]+/)[0].split("=")[1]; 
  }

  /**
   * A rough and ready iterator for selectively iterating over localStorage
   * and serving up the results
   * @param  {string}     match       A string or regex to filter each iteration
   * @param  {*}          collection  localStorage or other collection with similar API
   * @param  {function}   callback    A callback function to execute against matching items
   * @return {array}                  An array of suitably filtered items
   */
  function each(match, collection, callback){
    var output = []; 

    /** Iterate over collection - and execute the callback against the matching 
    items given match (string) */
    for(var key in collection){
      
      if(key.match(match)){
        output.push(callback(collection.getItem(key))); 
      }

    }
    return output;
  }

  /**
   * Using the revealing module pattern expose a simple API with methods for 
   * working on various problems in the application solution domain, including
   * checking if an array contains a value, iterating over localStorage, JSON
   * parsing localStorage entries, getting the current session id and converting
   * a credit card expiry date into a form more suitable for consumption by the
   * PHP server.
   * 
   * This object will be available elsewhere in the application by this name: 
   *
   * UtilityService
   * 
   * and the relevant methods will be called as follows:
   * 
   * UtilityService.contains(value, array)
   * UtilityService.convertExpiry(expiry)
   * UtilityService.each(match, collection, callback, params)
   * UtilityService.getSessionId()
   * UtilityService.parse(item)
   *
   */
  return {
    contains: contains,
    convertExpiry: convertExpiry,
    each: each, 
    getSessionId: getSessionId, 
    parse: parse
  }
}

/** Register UtilityService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('UtilityService', utilityService);