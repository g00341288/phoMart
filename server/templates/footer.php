
    <div class="universal-padding"></div>
    <!----------- Footer ------------>
    <footer class="footer-bs universal-padding" ng-controller="HomeController">
        <div class="row">
        	<div class="col-md-3 footer-brand animated fadeInLeft">
            	<h2>phoMart</h2>
                <p>Thank you for shopping at phoMart. Our business philosophy revolves around providing dated mobile handsets to discerning hipsters in a mildly ironic way. If you are looking for something and you didn't find it here please don't hesitate to reach out.</p>
                <p>© 2016 phoMart LLC - All rights reserved</p>
            </div>
        	<div class="col-md-4 footer-nav animated fadeInUp">
            	
            	<div class="col-md-12">
                    <h4>Site</h4>
                    <ul class="list">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="https://g00341288.github.io/web-application-development/">Module Website</a></li>
                    </ul>
                </div>
            </div>
        	<div class="col-md-2 footer-social animated fadeInDown">
            	<h4>Follow Us</h4>
            	<ul>
                	<li><a href="#">Facebook</a></li>
                	<li><a href="#">Twitter</a></li>
                	<li><a href="#">Instagram</a></li>
                </ul>
            </div>
        	<div class="col-md-3 footer-ns animated fadeInRight">
            	<h4>Search</h4>
                <p>You won't find much here beyond a dumb pop-up to tell you that you won't find anything!</p>
                <p>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search for...">
                      <span class="input-group-btn">
                        <button uib-popover="{{dynamicPopover.content}}" popover-title="{{dynamicPopover.title}}" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                      </span>
                    </div><!-- /input-group -->
                 </p>
            </div>
        </div>
    </footer>