  /**
   * domr v.0.0.0 | Leonard M Reidy
   * A simple library for constructing string representations of 
   * DOM elements to simplify the process of dynamically populating HTML pages. 
   * The goal of the library is to provide a cleaner JavaScript way to generate
   * string representations of DOM elements 
   * @return {object} domr object
   */
  (function() {
    
  var window = this,
  undefined;
  
  /**
   * Define domr function in the global context (window object)
   * this function calls an initialisation function called init
   * which belongs to a subproperty of domr
   * @return {object}          Freshly initialised domr object
   */
  domr = window.domr = function() {
    return new domr.domrm.init();
  };
   
  domr.domrm = domr.prototype = {
    /**
     * Constructor for library - every time domr() is called
     * it is the equivalent to calling new domr.domrm.init()
     * init adds properties to the newly-constructed copy
     * of domr, then returns the results to the global scope
     * @return {object}          domr object
     */
    init: function() {
      // initialise domr object
      // return initialised object
    },  

    /**
     * Given a tag name, attributes and content, construct a 
     * string representation of a given DOM element
     * @param  {string} tag     A string identify the tag name
     * @param  {object} attrs   A configuration object representing element attrs
     * @param  {*}      content A string, domr object, or other html element representation
     * @return {string}         A string representation of a DOM element
     */
    html: function(tag, attrs, content) {

      switch (tag){
        case "br": return "<br>";
        case "hr": return "<hr>"; 
        case "em": return "<em>" + content + "</em>";
        case "strong": return "<strong>" + content + "</strong>";
        default: break; 
      }

      var openTag = "<"+tag;
      var tagBody = "";
      var closeTag = "</"+tag+">";
      var attrsKeys = [];

      if(arguments.length < 2) {
        if(typeof attrs === "string") {
          return openTag + ">" + attrs + closeTag;
        }
        else {
          return openTag + ">" + closeTag;
        }
      }
      else {
        attrsKeys = Object.keys(attrs);

        for(var i = 0; i < attrsKeys.length; i++){
          tagBody += " " + attrsKeys[i] + "='" + attrs[attrsKeys[i]] + "'";
        }
          
        // console.log(tagBody);
      }
      return openTag + tagBody + ">" + content + closeTag;
    },

    /**
     * Expose namespaced library function (html) on global object
     * Use this only when you can be confident that other 
     * libraries will not conflict with this one - this is a
     * convenience method suitable for use during development
     * only; do not use in a production application
     * @return {function} HTML string factory
     */
    expose: function(){
      return this.html;
    }

  }; 

  /**
   * Close the prototype circle - set the domr.domrm.init prototype
   * be a reference to domr.domrm
   * @type {object}
   */
  domr.domrm.init.prototype = domr.domrm;
  })();