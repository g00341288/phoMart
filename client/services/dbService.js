/** 
 * A service which exposes an API for making requests against the phoMart database
 * The service returns an object with methods corresponding to the 4 principal
 * database transactions: create, retrieve, update, and delete (CRUD)
 * @return {object} Object comprising key/value pairs representing service methods
 * for making requests against the phoMart database
 */
function dbQueryService($http){

  /**
   * Create a record in a given table of the wad database - the table is identified
   * in the params to the method
   * @param  {string} baseUrl Resource locator or service base url
   * @param  {string} params  Parameters to be passed to the PHP interpreter
   * @return {object}         Query response object
   */
  function createRecord(baseUrl, params){

    return $http.post(baseUrl, params).then(function(res, status, headers, config){  

      return res;
      }, function(res){
        console.log('Something went wrong!'); 
        console.log(res);
      });
  }

  /**
   * Retrieve a record from a given table of the wad database - the table is identified
   * in the params to the method
   * @param  {string} baseUrl Resource locator or service base url
   * @param  {object} params  Parameters to be passed to the PHP interpreter
   * @return {object}         Query response object
   */
  function retrieveRecord(baseUrl, params) {
    return $http.get(baseUrl, params).then(function(res, status, headers, config){
      return res;
    }, function(res){
      console.log('Something went wrong!');
      console.log(res);
    });
  }

  /**
   * Update a record in the product table of the wad database - the table is identified
   * in the params to the method
   * @param  {string} baseUrl Resource locator or service base url
   * @param  {string} params  Parameters to be passed to the PHP interpreter
   * @return {object}         Query response object
   */
  function updateRecord(baseUrl, params){

    return $http.put(baseUrl, params).then(function(res, status, headers, config){  

      return res;
      }, function(res){
        console.log('Something went wrong!'); 
        console.log(res);
      });

  }

  /**
   * Delete a record in a given table of the wad database - the table is identified
   * in the params to the method
   * @param  {string} baseUrl Resource locator or service base url
   * @param  {string} params  Parameters to be passed to the PHP interpreter
   * @return {object}         Query response object
   */
  function deleteRecord(baseUrl, params){
   return $http.delete(baseUrl, params).then(function(res, status, headers, config){  
     return res;
     }, function(res){
       console.log('Something went wrong!'); 
       console.log(res);
     });
  }
  /**
   * Using the revealing module pattern expose a simple API for queries against 
   * the phoMart database. The API consists, simply, in an object comprising key/value
   * pairs that each represent a database transaction. 
   * 
   * This object will be available elsewhere in the application by this name: 
   *
   * DBService
   * 
   * and the relevant methods will be called as follows:
   * 
   * DBService.create(baseUrl, params)
   * DBService.retrieve(baseUrl, params)
   * DBService.update(baseUrl, params)
   * DBService.delete(baseUrl, params)
   *
   */
  return {
    create: createRecord,
    retrieve: retrieveRecord,
    update: updateRecord,
    delete: deleteRecord

  }
}

/** Register DBService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('DBService', dbQueryService);