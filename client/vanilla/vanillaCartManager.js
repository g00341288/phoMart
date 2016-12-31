/**
 * This file contains the code for the cart implementation. The rest of the site makes liberal
 * use of AngularJS, but it seemed to make more sense to write this module in jQuery to demonstrate
 * event handling/propagation and dynamic DOM construction in a more transparent way. AngularJS hides
 * alot of these details away behind one or another framework abstraction!
 */

/**
 * @type {object}		Create a new domr object outside the scope of jQuery's document.ready()
 * domr is not accessible from within the scope of the document.ready() function
 */
var domr = domr();

// A $( document ).ready() block for cart manager.
$( document ).ready(function(window) {

	/**------------------------------------------- DOM Construction ------------------------------------ */
	

	/** @type {function} 	Call domr expose() function to expose domr.html() on global 
	scope - for development only; in production you should preserve the namespacing
	provided by the domr library */
	var html = domr.expose();

	/**
	 * Construct a single table row as string
	 * @param  {string} imgSrc      A string representing the file path for the product image
	 * @param  {string} productName The product's name
	 * @param  {string} unitPrice   The unit price culled from localStorage
	 * @param  {string} total       The total price (calculated)
	 * @return {string}             A HTML table row
	 */
	function constructTableRow(imgSrc, productName, unitPrice, total, dataCartId){
		 
		 var removeButtonTD; 
		 var imageTD;
		 var productNameTD;
		 var unitPriceTD;
		 var totalTD; 
		 var tableRow;
		 var vat = 0.23;
		/**
		 * @type {string}		Construct a string representation of DOM element using domr library for
		 * the cells in the first column of the table
		 */
		removeButtonTD = 
		  html('td', {class: 'muted center_text'}, 
		    html('button', {class: 'btn btn-danger'}, 
		      html('span', {class: 'glyphicon glyphicon-remove'}, "" )));
		/**
		 * @type {string}		Construct a string representation of DOM element using domr library for
		 * the cells in the second column of the table
		 */
		imageTD = 
		  html('td', {class: 'muted center_text'}, 
		    html('a', {href: 'home.php'}, 
		      html('img', {class: 'img-thumbnail', title: 'Some title', src: imgSrc, 
		      style: 'width: 60px; height: auto'}, "")));
	  /**
	   * @type {string}		Construct a string representation of DOM element using domr library for
	   * the cells in the third column of the table
	   */
		productNameTD = html('td', {class: 'muted center_text'}, productName);
	  /**
	   * @type {string}		Construct a string representation of DOM element using domr library for
	   * the cells in the fourth column of the table
	   */
		unitPriceTD = html('td', {class: 'unit-price muted center_text'}, "€"+unitPrice); 
		/**
		 * @type {string}		Construct a string representation of DOM element using domr library for
		 * the cells in the fifth column of the table
		 */
		totalTD = html('td', {class: 'subtotal muted center_text'}, "€"+total);

		tableRow = html('tr', {'data-cart-id': dataCartId}, removeButtonTD + 
			imageTD + productNameTD + unitPriceTD + totalTD); 

		return tableRow;

	}
 
 	/**
 	 * Construct a table DOM element dynamically 
 	 * @param  {array} cartItemsArray An array of cart items
 	 * @param  {float} vat            Current vat rate
 	 * @return {string}               A HTML table element as string
 	 */
	function constructTable(cartItemsArray, vat) {

		var runningTotal = 0; 
		var total = 0; 

		var tableContents = ""; 
		var tableBodyContents = ""; 

		/** @type {string} Table head element */
		var thead = 
      html('thead', "", 
        html('tr', "", 
          html('th', "", 'Remove')+
          html('th', "", 'Image')+
          html('th', "", 'Product Name')+
          html('th', "", 'Unit Price')+
          html('th', "", 'Subtotal')));

    /**
     * Construct a table row for each element of the given cart items array (cartItemsArray)
     */
    for(var i = 0; i < cartItemsArray.length; i++){
    	runningTotal += parseFloat(cartItemsArray[i].price); 

      tableBodyContents += 
      	constructTableRow(cartItemsArray[i].image_0, 
      		cartItemsArray[i].name, 
      		cartItemsArray[i].price, 
      		runningTotal.toFixed(2), 
      		cartItemsArray[i].cart_id); 
    }

    /** @type {string} 	Calculate the total + vat */
    total = calculateTotalPlusVat(runningTotal, vat);
    
    /** @type {string} 	Construct total row DOM element as string */
    var totalRow = html('tr', "", 
    	html('td', {class: 'muted center_text'}, "")+
    	html('td', {class: 'muted center_text'}, "")+
    	html('td', {class: 'muted center_text'}, "")+
    	html('td', {class: 'muted center_text'}, html('strong', "", "Total (plus vat):"))+
    	html('td', {id: 'total', class: 'muted center_text'}, html('strong', "", "€"+calculateTotalPlusVat(runningTotal, vat))));

    /** Construct a body DOM element as string, append the total row to it, and append the result to the
    existing table contents */
    tableContents += html('tbody', "", tableBodyContents+totalRow);

    /** @type {string} 	A table DOM element as string concatenating the table head and table contents previously
    constructed */
		var table = html('table', {id: 'cart', class: 'table table-bordered table-striped'}, thead + tableContents);

		/** @type {string} A div DOM element as string, containing a button DOM element */
		var div = html('div', {id: 'proceedDiv', class: 'col-md-12'}, 
			html('div', {class: 'btn-group pull-right', role:'group', 'aria-label': ''},
				html('button', {type: 'button', class: 'continue-shopping btn btn-default'}, 'Continue Shopping') +
				html('button', {type: 'button', class: 'proceed btn btn-default'}, 'Proceed')));

		/** Concatenate the proceed div onto the existing table */
		table += div; 

		

		return table; 
		
	}


	/**--------------------------------------- Calculations ----------------------------------------- */

	function calculateTotalPlusVat(runningTotal, vat){
		var total = runningTotal + (runningTotal * vat); 
		return total.toFixed(2);
	}

	/**---------------------------------------- Sessions -------------------------------------------- */

	/**
	 * Use regular expression matching to get current session id from cookies
	 * @return {string} The current PHP session id as a string
	 */
	function getSessionId(){
	  return document.cookie.match(/PHPSESSID=[^;]+/)[0].split("=")[1]; 
	}

	/**---------------------------------------- Storage ---------------------------------------------- */

	/**
	 * JSON parse the given input
	 * @param  {string} item string representation of an object
	 * @return {object}      js object
	 */
	function parse(item){
		return JSON.parse(item);
	}

	/**
	 * Iterate over the given collection and execute the given callback 
	 * against items matched in the collection. Use built-in match method
	 * to retrieve matches when matching a string against a regular 
	 * expression. This method works like a contains() method, finding
	 * matches where the given string, such as a session id roughly matches
	 * a property in, for example, localStorage
	 * @param  {string}   match      A string used to find matches in the collection
	 * @param  {*}   collection      An array or object to be iterated over
	 * @param  {Function} callback   A callback to be executed 
	 * @return {array}               Outputs processed by the callback
	 */
	function each(match, collection, callback){

	  var output = []; 

	  for(var key in collection){
	    
	    if(key.match(match)){
	    	output.push(callback(collection[key]));
	    }

	  }
	  return output;
	}

	/**
	 * Retrieve all items in localStorage with a key that contains the current 
	 * session id
	 * @param  {object} localStorage Persistent storage in browser
	 * @param  {string} sessionId    Session id as a string
	 * @return {array}               An array of cart items
	 */
	function retrieveCartItemsFromLocalStorage(match, collection, callback) {
		return each(match, collection, callback);
	}
  
  /**------------------------------------------- Main ---------------------------------------------- */
  var path;

  /** @type {array} Cart items array */
  var cartItems = retrieveCartItemsFromLocalStorage(getSessionId(), localStorage, parse); 

  /** Construct a table with the cartItems array, and pass the vat rate for calculations on 
  total */
  $('div#cartContainer').append(constructTable(cartItems, 0.23));

  /** Add an event handler to the table element to capture clicks on 
  descendant button elements (events: bubble) */
  $('table').on('click', 'button', function(e){

  	var numberOfCartItems = 0; 
  	var sessionId = getSessionId();
  	var unitPriceArray = [];

  	/** Remove the closest table row to the current target (button) */
		$(event.target).closest('tr').remove();
		
		/** Iterate over localStorage, and, if an item is found with a key matching the data-cart-id
		attribute of the table row associated with the button that raised the click event, increment 
		numberOfCartItems, then delete the item from storage that corresponds to the given table row*/
		for(var key in localStorage){
			if(key.match(sessionId)){
				numberOfCartItems++;
			}
			if(key === $(event.target).closest('tr').attr('data-cart-id')){
				localStorage.removeItem(key);
			}
		}

		/** Decrement the number of cart items each time a row is deleted */
		numberOfCartItems--;

		/** Update the cart item counter in the nav menu - in a fully Angularised variant
		of this application, this responsibility would be borne by a publish/subscribe 
		service called on the cart controller, as it is currently in the Angular controller
		associated with the home/store page */
		$('span.items').text(" (" + numberOfCartItems + ")");

		/** @type {array} Get all unit prices and store in an array */
		unitPriceArray = $('td.unit-price').text().split("€");

		/** @type {number}	Set the first element of the unitPriceArray as 0 */
		unitPriceArray[0] = 0;

		/** @type {array} 	Array of converted values */
		unitPriceArray = unitPriceArray.map(Number); 

		/** recalculate total using .reduce() to sum the elements of the array and applying vat of 23% */
		var _total = calculateTotalPlusVat(unitPriceArray.reduce(function(a, b){return a + b;}), 0.23);

		/** Update the total cell in the table */
		$('td#total>strong').text("€" + _total);
  }); 

  /** Add an event handler to manage the transition to the order page  */
  $('button.proceed').on('click', function(){ 
  	
  	/** @type {string}	 Get the path to the current file using regular expression*/
  	path = document.location.href.match(/^.*[\\\/]/, '');

  	/** If the cart is empty, redirect to home page, otherwise, proceed to checkout */
  	if(retrieveCartItemsFromLocalStorage(getSessionId(), localStorage, parse).length <= 0){
  		alert('Cart is empty! Redirecting to home page');
  		document.location.href = path + 'index.php';
  	}
  	else {
  		/** Proceed to checkout */
  		document.location.href = path + 'checkout.php';
  	}
  	

  });

  /** Add an event handler to allow the user to return to the home/store page on clicking
  the 'Continue Shopping' button */
  $('button.continue-shopping').on('click', function(){

  	/** @type {string}	 Get the path to the current file using regular expression*/
  	path = document.location.href.match(/^.*[\\\/]/, '');
  	document.location.href = path + 'index.php';
  	
  }); 

});