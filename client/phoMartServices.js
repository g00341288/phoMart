/** 
 * A service which exposes an API for making requests against the phoMart database
 * The service returns an object with methods corresponding to the 4 principal
 * database transactions: create, retrieve, update, and delete (CRUD)
 * @return {object} Object comprising key/value pairs representing service methods
 * for making requests against the phoMart database
 */
function phoMartQueryService($http){


  function createRecord(baseUrl, params){

    return $http.post(baseUrl, params).then(function(res, status, headers, config){  

      return res;
      }, function(res){
        console.log('Something went wrong!'); 
        console.log(res);
      });
  }

  function retrieveRecord(baseUrl, params) {
    return $http.get(baseUrl, params).then(function(res, status, headers, config){
      return res;
    }, function(res){
      console.log('Something went wrong!');
      console.log(res);
    });
  }

  function updateRecord(baseUrl, params){

    return $http.put(baseUrl, params).then(function(res, status, headers, config){  

      return res;
      }, function(res){
        console.log('Something went wrong!'); 
        console.log(res);
      });

  }


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
   * PhoMartQueryService
   * 
   * and the relevant methods will be called as follows:
   * 
   * PhoMartQueryService.create(baseUrl, params)
   * PhoMartQueryService.retrieve(baseUrl, params)
   * PhoMartQueryService.update(baseUrl, params)
   * PhoMartQueryService.delete(baseUrl, params)
   *
   */
  return {
    create: createRecord,
    retrieve: retrieveRecord,
    update: updateRecord,
    delete: deleteRecord

  }
}

/** Register PhoMartQueryService with the services submodule of the phoMart module */
angular.module('phoMart.services').service('PhoMartQueryService', phoMartQueryService);