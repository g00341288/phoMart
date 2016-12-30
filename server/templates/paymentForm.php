<!-- AngularJS provides some built-in directives for form validation. In this form, any 
element with the 'required' attribute will cause a validation failure if the rule isn't 
satisfied. In the event that this validation failure occurs, a message will be displayed
in the DOM and the submit button will be disabled. The input for credit card CVV number 
has a rule that ensures a CVV must be at least 3 characters/digits in length. If it is 
not this will cause a validation failure, a message will be displayed in the DOM and 
the submit button will be disabled. -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12" ng-controller="PaymentFormController">
				<form name="paymentForm" novalidate>
				  <div class="form-group">
				    <label for="firstname">Firstname</label>
				    <input 
				    type="text" 
				    name="firstname" 
				    class="form-control" 
				    ng-model="payment.firstname" 
				    id="firstname"
				    placeholder="Firstname"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.firstname.$error.required">Firstname is required!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="surname">Surname</label>
				    <input 
				    type="text" 
				    name="surname" 
				    class="form-control" 
				    id="surname" 
				    placeholder="Surname" 
				    ng-model="payment.surname" 
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.surname.$error.required">Surname is required!
				    </div>
				  </div>
				  <hr>
				  <div class="form-group">
				    <label for="creditCardNumber">Credit Card Number</label>
				    <input 
				    type="text" 
				    name="creditCardNumber" 
				    class="form-control" 
				    id="creditCardNumber" 
				    placeholder="Credit Card Number"
				    ng-model="payment.creditCardNumber" 
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.creditCardNumber.$error.required">Credit Card Number is required!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="creditCardCVV">Credit Card CVV</label>
				    <input 
				    type="text" 
				    name="creditCardCVV" 
				    class="form-control" 
				    id="creditCardCVV" 
				    placeholder="Credit Card CVV" 
				    ng-model="payment.creditCardCVV"
				    ng-minlength="3"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.creditCardCVV.$error.required">Credit Card CVV Number is required!
				    </div>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.creditCardCVV.$error.minlength">Credit Card CVV Number must be at least 3 digits long!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="creditCardExpiry">Credit Card Expiry Date</label>
				    <input 
				    type="text" 
				    name="creditCardExpiry" 
				    class="form-control" 
				    id="creditCardExpiryDate" 
				    placeholder="Credit Card Expiry Date" 
				    ng-model="payment.creditCardExpiry"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.creditCardExpiry.$error.required">Credit Card Expiry Date is required!
				    </div>
				  </div>
				  <hr>
				  <div class="form-group">
				    <label for="addressLine1">Address Line 1</label>
				    <input 
				    type="text" 
				    name="addressLine1" 
				    class="form-control" 
				    id="addressLine1" 
				    placeholder="Address Line 1" 
				    ng-model="payment.addressLine1"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.addressLine1.$error.required">Address Line 1 is required!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="addressLine2">Address Line 2</label>
				    <input 
				    type="text" 
				    name="addressLine2" 
				    class="form-control" 
				    id="addressLine2" 
				    placeholder="Address Line 2" 
				    ng-model="payment.addressLine2"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.addressLine2.$error.required">Address Line 2 is required!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="addressLine3">Address Line 3</label>
				    <input 
				    type="text" 
				    name="addressLine3" 
				    class="form-control" 
				    id="addressLine3" 
				    placeholder="Address Line 3" 
				    ng-model="payment.addressLine3">
				  </div>
				  <div class="form-group">
				    <label for="city">City</label>
				    <input 
				    type="text" 
				    name="city" 
				    class="form-control" 
				    id="city" 
				    placeholder="City" 
				    ng-model="payment.city"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.city.$error.required">City is required!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="county">County</label>
				    <input 
				    type="text" 
				    name="county" 
				    class="form-control" 
				    id="county" 
				    placeholder="County" 
				    ng-model="payment.county"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.county.$error.required">County is required!
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="zip">Zip</label>
				    <input 
				    type="text" 
				    name="zip" 
				    class="form-control" 
				    id="zip" 
				    placeholder="Zip" 
				    ng-model="payment.zip">
				  </div>
				  <div class="form-group">
				    <label for="telephone">Telephone</label>
				    <input 
				    type="text" 
				    name="telephone" 
				    class="form-control" 
				    id="telephone" 
				    placeholder="Telephone"
				    ng-model="payment.telephone">
				  </div>
				  <div class="form-group">
				    <label for="mobile">Mobile</label>
				    <input 
				    type="text" 
				    name="mobile" 
				    class="form-control" 
				    id="mobile" 
				    placeholder="Mobile" 
				    ng-model="payment.mobile"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.mobile.$error.required">Mobile Number is required!
				    </div>
				  </div>
				  <button type="submit" 
				  class="btn btn-default"
				  ng-disabled="paymentForm.$invalid">Submit</button>
				</form> 
			</div>
			</div>
		</div>
	</div>
</section>