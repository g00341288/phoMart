/** 
 * A service which exposes an API for making requests against the phoMart database
 * The service returns an object with methods corresponding to the 4 principal
 * database transactions: create, retrieve, update, and delete (CRUD)
 * @return {object} Object comprising key/value pairs representing service methods
 * for making requests against the phoMart database
 */
function phoMartProductQueryService($http){

  /**
   * Create a record in the product table of the wad database
   * @param  {[type]} baseUrl [description]
   * @param  {[type]} params  [description]
   * @return {[type]}         [description]
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
   * Retrieve a record from the product table of the wad database
   * @param  {[type]} baseUrl [description]
   * @param  {[type]} params  [description]
   * @return {[type]}         [description]
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
   * Update a record in the product table of the wad database
   * @param  {[type]} baseUrl [description]
   * @param  {[type]} params  [description]
   * @return {[type]}         [description]
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
   * Delete a record in the product table of the wad database
   * @param  {[type]} baseUrl [description]
   * @param  {[type]} params  [description]
   * @return {[type]}         [description]
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
   * ProductService
   * 
   * and the relevant methods will be called as follows:
   * 
   * ProductService.create(baseUrl, params)
   * ProductService.retrieve(baseUrl, params)
   * ProductService.update(baseUrl, params)
   * ProductService.delete(baseUrl, params)
   *
   */
  return {
    create: createRecord,
    retrieve: retrieveRecord,
    update: updateRecord,
    delete: deleteRecord

  }
}

/** Register ProductService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('ProductService', phoMartProductQueryService);