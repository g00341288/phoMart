<!-- AngularJS provides some built-in directives for form validation, but it does not provide
credit card number validation. In the payments view, this page, I have used a combination of
Angular's built-in form validation tools and those supplied by the Angular Payments module: 
	
	https://github.com/laurihy/angular-payments

The validation rules are as follows: 

* any field with the 'required' attribute cannot be empty
* any field with the 'ng-minlength' attribute must be at least ng-minlength long
* credit card numbers must validate against the Luhn algorithm, a simple checksum
	formula to minimise common typos, transcription errors, transpositions of adjacent 
	digits, etc
* credit card cvv numbers must be at least three characters long and not more than 4
* 

In the event that these rules are violated, a hidden DOM element will be exposed to
display a suitable warning and the submit button will be disabled.

Also, it is not possible to enter more than a valid number of digits in the credit 
card number or cvv inputs, and the credit card expiry input field will only permit
dates in the correct format, and no dates in the past are accepted.
-->
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
				    <label for="creditCardNumber">Credit Card Number <span ng-show="payment.creditCardNumber == '4485558974684386'">(Dummy Credit Card Number)</span></label>
				    <input 
				    type="text" 
				    name="creditCardNumber" 
				    class="form-control" 
				    id="creditCardNumber" 
				    title="You can delete the dummy credit card number and try your own!"
				    placeholder="4485558974684386"
				    ng-model="payment.creditCardNumber" 
				    payments-validate="card"
				    payments-format="card"
				    required>
				    <div class="alert alert-danger" 
				    role="alert" 
				    ng-show="paymentForm.creditCardNumber.$invalid">
    				Error: A valid credit card number is required!
						</div>
				  </div>
				  <div class="form-group">
				    <label for="creditCardCVV">Credit Card CVV <span ng-show="payment.creditCardCVV == '393'">(Dummy Credit Card CVV)</span></label>
				    <input 
				    type="text" 
				    name="creditCardCVV" 
				    class="form-control" 
				    id="creditCardCVV" 
				    title="You can delete the dummy CVV number and try your own!"
				    placeholder="393" 
				    ng-model="payment.creditCardCVV"
				    payments-validate="cvc"
				    payments-format="cvc"
				    ng-minlength="3"
				    required>
				    <div class="alert alert-warning" 
				    role="alert"
				    ng-show="paymentForm.creditCardCVV.$error.minlength">Credit Card CVV Number must be at least 3 digits long!
				    </div>
				    <div class="alert alert-danger" 
				    role="alert" 
				    ng-show="paymentForm.creditCardCVV.$invalid">
    				Error: A valid credit card CVV number is required!
						</div>
				  </div>
				  <div class="form-group">
				    <label for="creditCardExpiry">Credit Card Expiry Date <span ng-show="payment.creditCardExpiry == '07/2017'">(Dummy Credit Card Expiry Date)</span></label>
				    <input 
				    type="text" 
				    name="creditCardExpiry" 
				    class="form-control" 
				    id="creditCardExpiryDate" 
				    placeholder="Credit Card Expiry Date" 
				    ng-model="payment.creditCardExpiry"
				    payments-validate="expiry"
				    payments-format="expiry"
				    required>
				    <div class="alert alert-danger" 
				    role="alert" 
				    ng-show="paymentForm.creditCardExpiry.$invalid">
    				Error: A valid credit card expiry date is required!
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
				  <button type="submit" class="btn btn-default" ng-disabled="paymentForm.$invalid">Submit</button>
				</form> 
			</div>
			</div>
		</div>
	</div>
</section>