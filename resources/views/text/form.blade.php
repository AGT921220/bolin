<div class="card-content">
<div class="card-body">

@include('language.header',['langs' => $langs])
<div class="tab-content">
@foreach($langs as $l)
<div class="tab-pane @if($l['id'] == 0) active @endif" id="tabs_{{ $l['id'] }}" aria-labelledby="home-tab" role="tabpanel">

<input type="hidden" name="lid[]" value="{{ $l['id'] }}">

<h4>City</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Search</label>
<input type="text" name="city_search[]" class="form-control" value="{{ $data->getSData($l['id'],'city_search') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Locate Me</label>
<input type="text" name="city_locate[]" class="form-control" value="{{ $data->getSData($l['id'],'city_locate') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Address</label>
<input type="text" name="city_address[]" class="form-control" value="{{ $data->getSData($l['id'],'city_address') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Landmark</label>
<input type="text" name="land_mark[]" class="form-control" value="{{ $data->getSData($l['id'],'land_mark') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Save City</label>
<input type="text" name="city_save[]" class="form-control" value="{{ $data->getSData($l['id'],'city_save') }}">
</div>
</div>

<h4>Homepage, Search, Menu Item, Cart</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Search Placeholder</label>
<input type="text" name="search[]" class="form-control" value="{{ $data->getSData($l['id'],'search') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Trending in</label>
<input type="text" name="trend_in[]" class="form-control" value="{{ $data->getSData($l['id'],'trend_in') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Exit App</label>
<input type="text" name="exit_app[]" class="form-control" value="{{ $data->getSData($l['id'],'exit_app') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Exit App Description</label>
<input type="text" name="exit_app_desc[]" class="form-control" value="{{ $data->getSData($l['id'],'exit_app_desc') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Exit App Confirm</label>
<input type="text" name="exit_app_confirm[]" class="form-control" value="{{ $data->getSData($l['id'],'exit_app_confirm') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Previous Order Check</label>
<input type="text" name="previous_order[]" class="form-control" value="{{ $data->getSData($l['id'],'previous_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Sort By</label>
<input type="text" name="sort_by[]" class="form-control" value="{{ $data->getSData($l['id'],'sort_by') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Rating</label>
<input type="text" name="rating[]" class="form-control" value="{{ $data->getSData($l['id'],'rating') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Nearest</label>
<input type="text" name="nearest[]" class="form-control" value="{{ $data->getSData($l['id'],'nearest') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">New Arrival</label>
<input type="text" name="new_arrival[]" class="form-control" value="{{ $data->getSData($l['id'],'new_arrival') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Km</label>
<input type="text" name="km[]" class="form-control" value="{{ $data->getSData($l['id'],'km') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Per Person</label>
<input type="text" name="per_person[]" class="form-control" value="{{ $data->getSData($l['id'],'per_person') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Search Page Title</label>
<input type="text" name="search_title[]" class="form-control" value="{{ $data->getSData($l['id'],'search_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Search Result For</label>
<input type="text" name="search_res[]" class="form-control" value="{{ $data->getSData($l['id'],'search_res') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Trending Search</label>
<input type="text" name="trend_search[]" class="form-control" value="{{ $data->getSData($l['id'],'trend_search') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Menu Page Title</label>
<input type="text" name="menu_title[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">View Info</label>
<input type="text" name="view_info[]" class="form-control" value="{{ $data->getSData($l['id'],'view_info') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Time</label>
<input type="text" name="delivery_time[]" class="form-control" value="{{ $data->getSData($l['id'],'delivery_time') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Closing Time</label>
<input type="text" name="close_time[]" class="form-control" value="{{ $data->getSData($l['id'],'close_time') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Store Close</label>
<input type="text" name="store_close[]" class="form-control" value="{{ $data->getSData($l['id'],'store_close') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">All Items</label>
<input type="text" name="all[]" class="form-control" value="{{ $data->getSData($l['id'],'all') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Size</label>
<input type="text" name="select_size[]" class="form-control" value="{{ $data->getSData($l['id'],'select_size') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Required Addon Text</label>
<input type="text" name="req_addon[]" class="form-control" value="{{ $data->getSData($l['id'],'req_addon') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Add To cart</label>
<input type="text" name="add_cart[]" class="form-control" value="{{ $data->getSData($l['id'],'add_cart') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Add To Cart Message</label>
<input type="text" name="add_cart_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'add_cart_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Remove Cart Message</label>
<input type="text" name="remove_cart_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'remove_cart_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Rating & Reviews</label>
<input type="text" name="rating_review[]" class="form-control" value="{{ $data->getSData($l['id'],'rating_review') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cart Page Title</label>
<input type="text" name="cart_title[]" class="form-control" value="{{ $data->getSData($l['id'],'cart_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Price</label>
<input type="text" name="cart_price[]" class="form-control" value="{{ $data->getSData($l['id'],'cart_price') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cart Qty</label>
<input type="text" name="cart_qty[]" class="form-control" value="{{ $data->getSData($l['id'],'cart_qty') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Have Discount</label>
<input type="text" name="have_discount[]" class="form-control" value="{{ $data->getSData($l['id'],'have_discount') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Apply Here</label>
<input type="text" name="apply_here[]" class="form-control" value="{{ $data->getSData($l['id'],'apply_here') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Sub Total</label>
<input type="text" name="sub_total[]" class="form-control" value="{{ $data->getSData($l['id'],'sub_total') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Charges</label>
<input type="text" name="d_charges[]" class="form-control" value="{{ $data->getSData($l['id'],'d_charges') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Discount</label>
<input type="text" name="discount[]" class="form-control" value="{{ $data->getSData($l['id'],'discount') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Total Payable</label>
<input type="text" name="total_payable[]" class="form-control" value="{{ $data->getSData($l['id'],'total_payable') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Checkout</label>
<input type="text" name="checkout[]" class="form-control" value="{{ $data->getSData($l['id'],'checkout') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Empty Cart</label>
<input type="text" name="empty[]" class="form-control" value="{{ $data->getSData($l['id'],'empty') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Start Shopping</label>
<input type="text" name="start_shopping[]" class="form-control" value="{{ $data->getSData($l['id'],'start_shopping') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Offer</label>
<input type="text" name="select_offer[]" class="form-control" value="{{ $data->getSData($l['id'],'select_offer') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Offer Apply</label>
<input type="text" name="apply[]" class="form-control" value="{{ $data->getSData($l['id'],'apply') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">No Offer</label>
<input type="text" name="no_offer[]" class="form-control" value="{{ $data->getSData($l['id'],'no_offer') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Remove Offer</label>
<input type="text" name="remove[]" class="form-control" value="{{ $data->getSData($l['id'],'remove') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Offer Applied</label>
<input type="text" name="offer_applied[]" class="form-control" value="{{ $data->getSData($l['id'],'offer_applied') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cashback Message</label>
<input type="text" name="cashback_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'cashback_msg') }}">
</div>

</div>

<h4>Login,Signup & Forgot Password</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Login Title</label>
<input type="text" name="login_title[]" class="form-control" value="{{ $data->getSData($l['id'],'login_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Email</label>
<input type="text" name="login_email[]" class="form-control" value="{{ $data->getSData($l['id'],'login_email') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Password</label>
<input type="text" name="login_password[]" class="form-control" value="{{ $data->getSData($l['id'],'login_password') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Login Button</label>
<input type="text" name="login_button[]" class="form-control" value="{{ $data->getSData($l['id'],'login_button') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Forgot Password</label>
<input type="text" name="forgot_pass[]" class="form-control" value="{{ $data->getSData($l['id'],'forgot_pass') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Dont have an account</label>
<input type="text" name="dont_have[]" class="form-control" value="{{ $data->getSData($l['id'],'dont_have') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Now</label>
<input type="text" name="signup_now[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_now') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Login Validation</label>
<input type="text" name="login_validation[]" class="form-control" value="{{ $data->getSData($l['id'],'login_validation') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Login Error</label>
<input type="text" name="login_error[]" class="form-control" value="{{ $data->getSData($l['id'],'login_error') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Title</label>
<input type="text" name="signup_title[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Description</label>
<input type="text" name="signup_desc[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_desc') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Name</label>
<input type="text" name="signup_name[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_name') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Phone</label>
<input type="text" name="signup_phone[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_phone') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Email</label>
<input type="text" name="signup_email[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_email') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Reffer Code</label>
<input type="text" name="rcode[]" class="form-control" value="{{ $data->getSData($l['id'],'rcode') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Password</label>
<input type="text" name="signup_password[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_password') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Button</label>
<input type="text" name="signup_btn[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_btn') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Error</label>
<input type="text" name="signup_error[]" class="form-control" value="{{ $data->getSData($l['id'],'signup_error') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Forgot Password Title</label>
<input type="text" name="forgot_title[]" class="form-control" value="{{ $data->getSData($l['id'],'forgot_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Forgot Description</label>
<input type="text" name="forgot_text[]" class="form-control" value="{{ $data->getSData($l['id'],'forgot_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Enter Email</label>
<input type="text" name="enter_email[]" class="form-control" value="{{ $data->getSData($l['id'],'enter_email') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Reset</label>
<input type="text" name="reset[]" class="form-control" value="{{ $data->getSData($l['id'],'reset') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Verify Email</label>
<input type="text" name="verify_email[]" class="form-control" value="{{ $data->getSData($l['id'],'verify_email') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Enter OTP</label>
<input type="text" name="enter_otp[]" class="form-control" value="{{ $data->getSData($l['id'],'enter_otp') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Verify</label>
<input type="text" name="verify[]" class="form-control" value="{{ $data->getSData($l['id'],'verify') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Choose New Password</label>
<input type="text" name="new_pass[]" class="form-control" value="{{ $data->getSData($l['id'],'new_pass') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">New Password</label>
<input type="text" name="new_password[]" class="form-control" value="{{ $data->getSData($l['id'],'new_password') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Confirm Password</label>
<input type="text" name="confirm_password[]" class="form-control" value="{{ $data->getSData($l['id'],'confirm_password') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Update</label>
<input type="text" name="update_pass[]" class="form-control" value="{{ $data->getSData($l['id'],'update_pass') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">OTP Sent Message</label>
<input type="text" name="otp_sent_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'otp_sent_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">OTP Validation</label>
<input type="text" name="otp_validation[]" class="form-control" value="{{ $data->getSData($l['id'],'otp_validation') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">New Password Validation</label>
<input type="text" name="new_pass_validation[]" class="form-control" value="{{ $data->getSData($l['id'],'new_pass_validation') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Confirm Password Validation</label>
<input type="text" name="confirm_pass_validation[]" class="form-control" value="{{ $data->getSData($l['id'],'confirm_pass_validation') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Password Update Message</label>
<input type="text" name="password_update_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'password_update_msg') }}">
</div>

</div>


<h4>Checkout Page</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Select Order Type</label>
<input type="text" name="order_type[]" class="form-control" value="{{ $data->getSData($l['id'],'order_type') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery</label>
<input type="text" name="delivery[]" class="form-control" value="{{ $data->getSData($l['id'],'delivery') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Pickup</label>
<input type="text" name="pickup[]" class="form-control" value="{{ $data->getSData($l['id'],'pickup') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Date Time</label>
<input type="text" name="order_date_time[]" class="form-control" value="{{ $data->getSData($l['id'],'order_date_time') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Today</label>
<input type="text" name="deliver_today[]" class="form-control" value="{{ $data->getSData($l['id'],'deliver_today') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Deliver Later</label>
<input type="text" name="deliver_later[]" class="form-control" value="{{ $data->getSData($l['id'],'deliver_later') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Date</label>
<input type="text" name="select_date[]" class="form-control" value="{{ $data->getSData($l['id'],'select_date') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Time</label>
<input type="text" name="select_time[]" class="form-control" value="{{ $data->getSData($l['id'],'select_time') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select</label>
<input type="text" name="select[]" class="form-control" value="{{ $data->getSData($l['id'],'select') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Personal Information</label>
<input type="text" name="persoanl_info[]" class="form-control" value="{{ $data->getSData($l['id'],'persoanl_info') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Name</label>
<input type="text" name="name[]" class="form-control" value="{{ $data->getSData($l['id'],'name') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Phone</label>
<input type="text" name="phone[]" class="form-control" value="{{ $data->getSData($l['id'],'phone') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Address</label>
<input type="text" name="address[]" class="form-control" value="{{ $data->getSData($l['id'],'address') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Landmark</label>
<input type="text" name="landmark[]" class="form-control" value="{{ $data->getSData($l['id'],'landmark') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Comment</label>
<input type="text" name="comment[]" class="form-control" value="{{ $data->getSData($l['id'],'comment') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Payment Method</label>
<input type="text" name="payment_method[]" class="form-control" value="{{ $data->getSData($l['id'],'payment_method') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Pay on Delivery</label>
<input type="text" name="cod[]" class="form-control" value="{{ $data->getSData($l['id'],'cod') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Stripe</label>
<input type="text" name="stripe[]" class="form-control" value="{{ $data->getSData($l['id'],'stripe') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Razor Pay</label>
<input type="text" name="razor[]" class="form-control" value="{{ $data->getSData($l['id'],'razor') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Stripe Payment Form Title</label>
<input type="text" name="stripe_title[]" class="form-control" value="{{ $data->getSData($l['id'],'stripe_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Card No</label>
<input type="text" name="card_no[]" class="form-control" value="{{ $data->getSData($l['id'],'card_no') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Exp Month</label>
<input type="text" name="exp_month[]" class="form-control" value="{{ $data->getSData($l['id'],'exp_month') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Exp Year</label>
<input type="text" name="exp_year[]" class="form-control" value="{{ $data->getSData($l['id'],'exp_year') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">CVV</label>
<input type="text" name="cvv[]" class="form-control" value="{{ $data->getSData($l['id'],'cvv') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Now</label>
<input type="text" name="book_now[]" class="form-control" value="{{ $data->getSData($l['id'],'book_now') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Stripe Validation Error</label>
<input type="text" name="stripe_validation[]" class="form-control" value="{{ $data->getSData($l['id'],'stripe_validation') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Stripe Config Error</label>
<input type="text" name="stripe_config[]" class="form-control" value="{{ $data->getSData($l['id'],'stripe_config') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Stripe Card no Validation Error</label>
<input type="text" name="card_no_validation[]" class="form-control" value="{{ $data->getSData($l['id'],'card_no_validation') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Success Title</label>
<input type="text" name="apt_success[]" class="form-control" value="{{ $data->getSData($l['id'],'apt_success') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Ref. No</label>
<input type="text" name="ref_no[]" class="form-control" value="{{ $data->getSData($l['id'],'ref_no') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Total Amount</label>
<input type="text" name="total_amount[]" class="form-control" value="{{ $data->getSData($l['id'],'total_amount') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Go Back</label>
<input type="text" name="go_back[]" class="form-control" value="{{ $data->getSData($l['id'],'go_back') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Add New</label>
<input type="text" name="address_add[]" class="form-control" value="{{ $data->getSData($l['id'],'address_add') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">No Address Message</label>
<input type="text" name="address_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'address_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">eCash Description</label>
<input type="text" name="ecash_desc[]" class="form-control" value="{{ $data->getSData($l['id'],'ecash_desc') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">eCash</label>
<input type="text" name="ecash[]" class="form-control" value="{{ $data->getSData($l['id'],'ecash') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Use eCash</label>
<input type="text" name="use_ecash[]" class="form-control" value="{{ $data->getSData($l['id'],'use_ecash') }}">
</div>


<div class="form-group col-md-4">
<label for="inputEmail6">No Running Order</label>
<input type="text" name="no_running_order[]" class="form-control" value="{{ $data->getSData($l['id'],'no_running_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">On Going Order</label>
<input type="text" name="on_going_order[]" class="form-control" value="{{ $data->getSData($l['id'],'on_going_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order From</label>
<input type="text" name="order_from[]" class="form-control" value="{{ $data->getSData($l['id'],'order_from') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Placed Text</label>
<input type="text" name="order_placed_text[]" class="form-control" value="{{ $data->getSData($l['id'],'order_placed_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Confirmed Text</label>
<input type="text" name="order_confirmed_text[]" class="form-control" value="{{ $data->getSData($l['id'],'order_confirmed_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Assign Text</label>
<input type="text" name="delivery_assign_text[]" class="form-control" value="{{ $data->getSData($l['id'],'delivery_assign_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order On the Way Text</label>
<input type="text" name="order_on_way[]" class="form-control" value="{{ $data->getSData($l['id'],'order_on_way') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Cancel Text</label>
<input type="text" name="order_cancel_text[]" class="form-control" value="{{ $data->getSData($l['id'],'order_cancel_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order No</label>
<input type="text" name="order_no[]" class="form-control" value="{{ $data->getSData($l['id'],'order_no') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Detail</label>
<input type="text" name="order_detail[]" class="form-control" value="{{ $data->getSData($l['id'],'order_detail') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Call</label>
<input type="text" name="call[]" class="form-control" value="{{ $data->getSData($l['id'],'call') }}">
</div>



</div>

<h4>My Account, My Orders</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Welcome</label>
<input type="text" name="welcome[]" class="form-control" value="{{ $data->getSData($l['id'],'welcome') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Referral Code</label>
<input type="text" name="ref_code[]" class="form-control" value="{{ $data->getSData($l['id'],'ref_code') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Ref Code Description</label>
<input type="text" name="ref_code_desc[]" class="form-control" value="{{ $data->getSData($l['id'],'ref_code_desc') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Account Title</label>
<input type="text" name="account_title[]" class="form-control" value="{{ $data->getSData($l['id'],'account_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Orders</label>
<input type="text" name="my[]" class="form-control" value="{{ $data->getSData($l['id'],'my') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Language Setting</label>
<input type="text" name="lang_setting[]" class="form-control" value="{{ $data->getSData($l['id'],'lang_setting') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Change Location</label>
<input type="text" name="change_location[]" class="form-control" value="{{ $data->getSData($l['id'],'change_location') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Back to Home</label>
<input type="text" name="back_home[]" class="form-control" value="{{ $data->getSData($l['id'],'back_home') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Logout</label>
<input type="text" name="logout[]" class="form-control" value="{{ $data->getSData($l['id'],'logout') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Date</label>
<input type="text" name="order_date[]" class="form-control" value="{{ $data->getSData($l['id'],'order_date') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Status</label>
<input type="text" name="status[]" class="form-control" value="{{ $data->getSData($l['id'],'status') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Item</label>
<input type="text" name="item[]" class="form-control" value="{{ $data->getSData($l['id'],'item') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Quantity</label>
<input type="text" name="qty[]" class="form-control" value="{{ $data->getSData($l['id'],'qty') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Price</label>
<input type="text" name="price[]" class="form-control" value="{{ $data->getSData($l['id'],'price') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">No Order</label>
<input type="text" name="no_order[]" class="form-control" value="{{ $data->getSData($l['id'],'no_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cancel Order</label>
<input type="text" name="cancel_order[]" class="form-control" value="{{ $data->getSData($l['id'],'cancel_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cancel Order Confirmation</label>
<input type="text" name="cancel_order_confirm[]" class="form-control" value="{{ $data->getSData($l['id'],'cancel_order_confirm') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cancel Order Confirmation Description</label>
<input type="text" name="cancel_order_confirm_desc[]" class="form-control" value="{{ $data->getSData($l['id'],'cancel_order_confirm_desc') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Rating Title</label>
<input type="text" name="rating_title[]" class="form-control" value="{{ $data->getSData($l['id'],'rating_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Rating Description</label>
<input type="text" name="rating_des[]" class="form-control" value="{{ $data->getSData($l['id'],'rating_des') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Submit Button</label>
<input type="text" name="submit_btn[]" class="form-control" value="{{ $data->getSData($l['id'],'submit_btn') }}">
</div>

</div>

<h4>Other Pages & Navigation</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Menu Welcome Text</label>
<input type="text" name="menu_welcome[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_welcome') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Home</label>
<input type="text" name="menu_home[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_home') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Orders</label>
<input type="text" name="menu_my[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_my') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Account</label>
<input type="text" name="menu_my_account[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_my_account') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Language Setting</label>
<input type="text" name="menu_lang[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_lang') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Change Location</label>
<input type="text" name="menu_location[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_location') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Running Orders</label>
<input type="text" name="running_order[]" class="form-control" value="{{ $data->getSData($l['id'],'running_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">About Us</label>
<input type="text" name="menu_about[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_about') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">FAQs</label>
<input type="text" name="menu_faq[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_faq') }}">
</div>


<div class="form-group col-md-4">
    <label for="inputEmail6">Categorías</label>
    <input type="text" name="menu_categories[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_categories') }}">
    </div>
    
    
<div class="form-group col-md-4">
<label for="inputEmail6">Contact Us</label>
<input type="text" name="menu_contact[]" class="form-control" value="{{ $data->getSData($l['id'],'menu_contact') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Change Language Title</label>
<input type="text" name="lang_title[]" class="form-control" value="{{ $data->getSData($l['id'],'lang_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Update Language</label>
<input type="text" name="update_lang[]" class="form-control" value="{{ $data->getSData($l['id'],'update_lang') }}">
</div>
</div>

<h4>Delivery App</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Login Phone</label>
<input type="text" name="d_login_phone[]" class="form-control" value="{{ $data->getSData($l['id'],'d_login_phone') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Home Title</label>
<input type="text" name="d_home_title[]" class="form-control" value="{{ $data->getSData($l['id'],'d_home_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Active</label>
<input type="text" name="d_active[]" class="form-control" value="{{ $data->getSData($l['id'],'d_active') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Offline</label>
<input type="text" name="d_offline[]" class="form-control" value="{{ $data->getSData($l['id'],'d_offline') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">No Order</label>
<input type="text" name="d_no_order[]" class="form-control" value="{{ $data->getSData($l['id'],'d_no_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order id</label>
<input type="text" name="d_order_id[]" class="form-control" value="{{ $data->getSData($l['id'],'d_order_id') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">User</label>
<input type="text" name="d_user[]" class="form-control" value="{{ $data->getSData($l['id'],'d_user') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Phone</label>
<input type="text" name="d_phone[]" class="form-control" value="{{ $data->getSData($l['id'],'d_phone') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Address</label>
<input type="text" name="d_address[]" class="form-control" value="{{ $data->getSData($l['id'],'d_address') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">View Detail</label>
<input type="text" name="d_view_detail[]" class="form-control" value="{{ $data->getSData($l['id'],'d_view_detail') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Accept Order</label>
<input type="text" name="d_accept[]" class="form-control" value="{{ $data->getSData($l['id'],'d_accept') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Show Direction</label>
<input type="text" name="d_show_dir[]" class="form-control" value="{{ $data->getSData($l['id'],'d_show_dir') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Items</label>
<input type="text" name="d_order_item[]" class="form-control" value="{{ $data->getSData($l['id'],'d_order_item') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Other Info</label>
<input type="text" name="d_other_info[]" class="form-control" value="{{ $data->getSData($l['id'],'d_other_info') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Total Amount</label>
<input type="text" name="d_total_amount[]" class="form-control" value="{{ $data->getSData($l['id'],'d_total_amount') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Payment Method</label>
<input type="text" name="d_payment_method[]" class="form-control" value="{{ $data->getSData($l['id'],'d_payment_method') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cash on Delivery</label>
<input type="text" name="d_cod[]" class="form-control" value="{{ $data->getSData($l['id'],'d_cod') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Online Paid</label>
<input type="text" name="d_online[]" class="form-control" value="{{ $data->getSData($l['id'],'d_online') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">eCash Paid</label>
<input type="text" name="d_ecash_paid[]" class="form-control" value="{{ $data->getSData($l['id'],'d_ecash_paid') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Paid with eCash</label>
<input type="text" name="d_paid_ecash[]" class="form-control" value="{{ $data->getSData($l['id'],'d_paid_ecash') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Total Payable</label>
<input type="text" name="d_total_pay[]" class="form-control" value="{{ $data->getSData($l['id'],'d_total_pay') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Start Ride</label>
<input type="text" name="d_start_ride[]" class="form-control" value="{{ $data->getSData($l['id'],'d_start_ride') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Complete Ride</label>
<input type="text" name="d_complete_ride[]" class="form-control" value="{{ $data->getSData($l['id'],'d_complete_ride') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Confirm Status Change</label>
<input type="text" name="d_confirm[]" class="form-control" value="{{ $data->getSData($l['id'],'d_confirm') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Delivered Start</label>
<input type="text" name="d_order_start[]" class="form-control" value="{{ $data->getSData($l['id'],'d_order_start') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Delivered Message</label>
<input type="text" name="d_order_delivered[]" class="form-control" value="{{ $data->getSData($l['id'],'d_order_delivered') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Account Title</label>
<input type="text" name="d_account_title[]" class="form-control" value="{{ $data->getSData($l['id'],'d_account_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Order</label>
<input type="text" name="d_my_order[]" class="form-control" value="{{ $data->getSData($l['id'],'d_my_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Change Password</label>
<input type="text" name="d_change_pass[]" class="form-control" value="{{ $data->getSData($l['id'],'d_change_pass') }}">
</div>
</div>

<h4>Store App</h4>

<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail6">Dont Have Account</label>
<input type="text" name="s_dont_have[]" class="form-control" value="{{ $data->getSData($l['id'],'s_dont_have') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Now</label>
<input type="text" name="s_signup_now[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_now') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Title</label>
<input type="text" name="s_signup_title[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_title') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Signup Description</label>
<input type="text" name="s_signup_desc[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_desc') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Signup Name</label>
<input type="text" name="s_signup_name[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_name') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Signup Phone</label>
<input type="text" name="s_signup_phone[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_phone') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Signup Address</label>
<input type="text" name="s_signup_address[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_address') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Signup Password</label>
<input type="text" name="s_signup_pass[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_pass') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Submit Button</label>
<input type="text" name="s_submit[]" class="form-control" value="{{ $data->getSData($l['id'],'s_submit') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Orders Overview</label>
<input type="text" name="s_order_overview[]" class="form-control" value="{{ $data->getSData($l['id'],'s_order_overview') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Total Order</label>
<input type="text" name="s_total_order[]" class="form-control" value="{{ $data->getSData($l['id'],'s_total_order') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Completed Order</label>
<input type="text" name="s_complete_order[]" class="form-control" value="{{ $data->getSData($l['id'],'s_complete_order') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">New Orders</label>
<input type="text" name="s_new_order[]" class="form-control" value="{{ $data->getSData($l['id'],'s_new_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cancelled Order</label>
<input type="text" name="s_cancel_order[]" class="form-control" value="{{ $data->getSData($l['id'],'s_cancel_order') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Delivery</label>
<input type="text" name="s_delivery[]" class="form-control" value="{{ $data->getSData($l['id'],'s_delivery') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Pickup</label>
<input type="text" name="s_pickup[]" class="form-control" value="{{ $data->getSData($l['id'],'s_pickup') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">New Order Status</label>
<input type="text" name="s_new_order_status[]" class="form-control" value="{{ $data->getSData($l['id'],'s_new_order_status') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Confirm Order Status</label>
<input type="text" name="s_confirm_order_status[]" class="form-control" value="{{ $data->getSData($l['id'],'s_confirm_order_status') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Assign Status</label>
<input type="text" name="s_delivery_assign_status[]" class="form-control" value="{{ $data->getSData($l['id'],'s_delivery_assign_status') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">On the way Status</label>
<input type="text" name="s_on_way_status[]" class="form-control" value="{{ $data->getSData($l['id'],'s_on_way_status') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">eCash Used</label>
<input type="text" name="s_ecash_used[]" class="form-control" value="{{ $data->getSData($l['id'],'s_ecash_used') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Cancel Order</label>
<input type="text" name="s_canceled_order[]" class="form-control" value="{{ $data->getSData($l['id'],'s_canceled_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Confirm Order</label>
<input type="text" name="s_confirm_order[]" class="form-control" value="{{ $data->getSData($l['id'],'s_confirm_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Assign Delivery</label>
<input type="text" name="s_assign_delivery[]" class="form-control" value="{{ $data->getSData($l['id'],'s_assign_delivery') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Delivery Boy</label>
<input type="text" name="s_select_delivery_boy[]" class="form-control" value="{{ $data->getSData($l['id'],'s_select_delivery_boy') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Assign Button</label>
<input type="text" name="s_assign_btn[]" class="form-control" value="{{ $data->getSData($l['id'],'s_assign_btn') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Cancel Message</label>
<input type="text" name="s_order_cancel_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'s_order_cancel_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Order Status Message</label>
<input type="text" name="s_order_status_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'s_order_status_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Update Account Setting</label>
<input type="text" name="s_update_account[]" class="form-control" value="{{ $data->getSData($l['id'],'s_update_account') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Charges</label>
<input type="text" name="s_delivery_charges[]" class="form-control" value="{{ $data->getSData($l['id'],'s_delivery_charges') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Enter KM for Fix Delivery Charges</label>
<input type="text" name="s_enter_km_fix[]" class="form-control" value="{{ $data->getSData($l['id'],'s_enter_km_fix') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Enter Amount for Fix Charges</label>
<input type="text" name="s_enter_amount_fix[]" class="form-control" value="{{ $data->getSData($l['id'],'s_enter_amount_fix') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Amount will be charged after fix KM</label>
<input type="text" name="s_amount_after[]" class="form-control" value="{{ $data->getSData($l['id'],'s_amount_after') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Max Delivery Area in KM</label>
<input type="text" name="s_max_delivery[]" class="form-control" value="{{ $data->getSData($l['id'],'s_max_delivery') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Store Open/Close & Change Password</label>
<input type="text" name="s_store_open_close[]" class="form-control" value="{{ $data->getSData($l['id'],'s_store_open_close') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Store Open</label>
<input type="text" name="s_store_open[]" class="form-control" value="{{ $data->getSData($l['id'],'s_store_open') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Email Error</label>
<input type="text" name="s_email_error[]" class="form-control" value="{{ $data->getSData($l['id'],'s_email_error') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Setting Updated Message</label>
<input type="text" name="s_setting_update[]" class="form-control" value="{{ $data->getSData($l['id'],'s_setting_update') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Menu Items</label>
<input type="text" name="s_menu_item[]" class="form-control" value="{{ $data->getSData($l['id'],'s_menu_item') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">All Items</label>
<input type="text" name="s_all_item[]" class="form-control" value="{{ $data->getSData($l['id'],'s_all_item') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Edit</label>
<input type="text" name="s_edit[]" class="form-control" value="{{ $data->getSData($l['id'],'s_edit') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Small Price</label>
<input type="text" name="s_small_price[]" class="form-control" value="{{ $data->getSData($l['id'],'s_small_price') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Medium Price</label>
<input type="text" name="s_medium_price[]" class="form-control" value="{{ $data->getSData($l['id'],'s_medium_price') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Full/Large Price</label>
<input type="text" name="s_full_price[]" class="form-control" value="{{ $data->getSData($l['id'],'s_full_price') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Message</label>
<input type="text" name="s_signup_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'s_signup_msg') }}">
</div>
<div class="form-group col-md-4">
<label for="inputEmail6">Close</label>
<input type="text" name="close[]" class="form-control" value="{{ $data->getSData($l['id'],'close') }}">
</div>
</div>

<h4>Other Info</h4>

<div class="row">
<div class="form-group col-md-4">
<label for="inputEmail6">Time Period</label>
<input type="text" name="time_period[]" class="form-control" value="{{ $data->getSData($l['id'],'time_period') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Pay with Cash</label>
<input type="text" name="pay_with_cash[]" class="form-control" value="{{ $data->getSData($l['id'],'pay_with_cash') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Bank Transfer</label>
<input type="text" name="bank_transfer[]" class="form-control" value="{{ $data->getSData($l['id'],'bank_transfer') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Terms & Condition</label>
<input type="text" name="term[]" class="form-control" value="{{ $data->getSData($l['id'],'term') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Terms & Condition Text</label>
<input type="text" name="term_text[]" class="form-control" value="{{ $data->getSData($l['id'],'term_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Plan</label>
<input type="text" name="my_plan[]" class="form-control" value="{{ $data->getSData($l['id'],'my_plan') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Plan Text</label>
<input type="text" name="my_plan_text[]" class="form-control" value="{{ $data->getSData($l['id'],'my_plan_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Valid Till</label>
<input type="text" name="valid_till[]" class="form-control" value="{{ $data->getSData($l['id'],'valid_till') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Change Plan</label>
<input type="text" name="change_plan[]" class="form-control" value="{{ $data->getSData($l['id'],'change_plan') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Select Plan</label>
<input type="text" name="select_plan[]" class="form-control" value="{{ $data->getSData($l['id'],'select_plan') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Any Notes For Payment</label>
<input type="text" name="notes_bank[]" class="form-control" value="{{ $data->getSData($l['id'],'notes_bank') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Earning</label>
<input type="text" name="my_earn[]" class="form-control" value="{{ $data->getSData($l['id'],'my_earn') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">My Earning Text</label>
<input type="text" name="my_earn_text[]" class="form-control" value="{{ $data->getSData($l['id'],'my_earn_text') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Total Completed Order</label>
<input type="text" name="total_complete_order[]" class="form-control" value="{{ $data->getSData($l['id'],'total_complete_order') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Total Earn</label>
<input type="text" name="total_earn[]" class="form-control" value="{{ $data->getSData($l['id'],'total_earn') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">From This Month</label>
<input type="text" name="from_month[]" class="form-control" value="{{ $data->getSData($l['id'],'from_month') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Eta</label>
<input type="text" name="eta[]" class="form-control" value="{{ $data->getSData($l['id'],'eta') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Recommended For You</label>
<input type="text" name="reco[]" class="form-control" value="{{ $data->getSData($l['id'],'reco') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Out of Stock</label>
<input type="text" name="out_stock[]" class="form-control" value="{{ $data->getSData($l['id'],'out_stock') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Out of Stock Message</label>
<input type="text" name="out_stock_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'out_stock_msg') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Out of Stock Message for Checkout</label>
<input type="text" name="out_stock_msg_checkout[]" class="form-control" value="{{ $data->getSData($l['id'],'out_stock_msg_checkout') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Login Button</label>
<input type="text" name="login_btn[]" class="form-control" value="{{ $data->getSData($l['id'],'login_btn') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Signup Button</label>
<input type="text" name="sign_btn[]" class="form-control" value="{{ $data->getSData($l['id'],'sign_btn') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Title</label>
<input type="text" name="delivery_title[]" class="form-control" value="{{ $data->getSData($l['id'],'delivery_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Dining Title</label>
<input type="text" name="dinein_title[]" class="form-control" value="{{ $data->getSData($l['id'],'dinein_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Location Title</label>
<input type="text" name="location_title[]" class="form-control" value="{{ $data->getSData($l['id'],'location_title') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">View Direction</label>
<input type="text" name="direction[]" class="form-control" value="{{ $data->getSData($l['id'],'direction') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Contact No</label>
<input type="text" name="contact_no[]" class="form-control" value="{{ $data->getSData($l['id'],'contact_no') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Call Now</label>
<input type="text" name="call_now[]" class="form-control" value="{{ $data->getSData($l['id'],'call_now') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Timing</label>
<input type="text" name="timing[]" class="form-control" value="{{ $data->getSData($l['id'],'timing') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Avg Per Person</label>
<input type="text" name="avg_per[]" class="form-control" value="{{ $data->getSData($l['id'],'avg_per') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">View Menu</label>
<input type="text" name="view_menu[]" class="form-control" value="{{ $data->getSData($l['id'],'view_menu') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Access Page</label>
<input type="text" name="access_page[]" class="form-control" value="{{ $data->getSData($l['id'],'access_page') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Pay With Paypal</label>
<input type="text" name="pay_paypal[]" class="form-control" value="{{ $data->getSData($l['id'],'pay_paypal') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Pay With PayStack</label>
<input type="text" name="pay_paystack[]" class="form-control" value="{{ $data->getSData($l['id'],'pay_paystack') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Paypal Payment Faild Message</label>
<input type="text" name="paypal_fail[]" class="form-control" value="{{ $data->getSData($l['id'],'paypal_fail') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Paypal Not Config Message</label>
<input type="text" name="text_paypal_wrong[]" class="form-control" value="{{ $data->getSData($l['id'],'text_paypal_wrong') }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">Delivery Charge Message</label>
<input type="text" name="d_charge_msg[]" class="form-control" value="{{ $data->getSData($l['id'],'d_charge_msg') }}">
</div>

</div>

</div>
@endforeach
</div>

<button type="submit" class="btn btn-success btn-cta">Save changes</button><br><br>
</div>
</div>