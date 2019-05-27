<?php 
    require_once 'core/init.php';
    include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-12">
       
            <div class="col-md-9" id="preReservationSummary">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">GUEST DETAILS<span class="glyphicon glyphicon-home pull-right"></span></h4>
                    </div>
                    <div class="panel-body">
                     <form  role="form"  id="checkoutForm" data-parsley-validate>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="guestFirstName" id="guestFirstName" class="form-control input-lg" placeholder="First Name" tabindex="1"
                                        data-parsley-required-message="first name is required"
                                        data-parsley-trigger="change focusout" data-parsley-pattern="/^[a-zA-Z]*$/"
                                        data-parsley-minlength="3" data-parsley-required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="guestLastName" id="guestLastName" class="form-control input-lg" placeholder="Last Name" tabindex="2"
                                        data-parsley-required-message="last name is required"
                                        data-parsley-trigger="change focusout" data-parsley-pattern="/^[a-zA-Z]*$/"
                                        data-parsley-minlength="3" data-parsley-required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="email" name="guestEmail" id="guestEmail" class="form-control input-lg" placeholder="Email Address" tabindex="3"
                                        data-parsley-required-message="email is required"
                                        data-parsley-trigger="change focusout"  data-parsley-type="email"
                                        data-parsley-minlength="3" data-parsley-required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="guestPhone" id="guestPhone" class="form-control input-lg" placeholder="Phone" tabindex="4"
                                        data-parsley-required-message="contact number is required"
                                        data-parsley-trigger="change focusout" data-parsley-type="digits" 
                                        data-parsley-minlength="10" data-parsley-required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="guestAddress" id="guestAddress" class="form-control input-lg" placeholder="Address" tabindex="5"
                                data-parsley-required-message="address is required"
                                data-parsley-trigger="change focusout"
                                data-parsley-minlength="3" data-parsley-required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="guestAddress2" id="guestAddress2" class="form-control input-lg"  tabindex="6">
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="guestPostalCode" id="guestPostalCode" class="form-control input-lg" placeholder="PostalCode" tabindex="7"
                                        data-parsley-required-message="postal code number is required"
                                        data-parsley-trigger="change focusout" data-parsley-type="digits" 
                                        data-parsley-minlength="4" data-parsley-required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <select name="guestCountry" id="guestCountry" class="wide" data-parsley-required>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Mozambique">Mozambique</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                            
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h5 class="text-center"><b>YOUR RESERVATION</b></h5>
                    </div>
                    <div class="panel-body text-center" id="preSelectedSummary">
                        <p><b> </b></br></p>
                        <p>Arriving On <b><?php echo $_SESSION['reservation_meta']['arrival'];?></b></p>
                        <br/>
                        <p>Leaving On <b><?php echo $_SESSION['reservation_meta']['departure'];?></b></p>
                        <br/>
                        <p><?php echo $_SESSION['reservation_meta']['roomsCount'] ;?> Room(s) | <?php echo $_SESSION['reservation']['adult_max_capacity'] ;?>  Adults  | <?php echo $_SESSION['reservation']['child_max_capacity'] ;?> Children</p>
                        <br/>
                        <p>Price/Night - R<?php echo $_SESSION['reservation']['price'] ;?> x <?php echo $_SESSION['reservation_meta']['dateDiff'] ;?></p>
                        <br/>
                        <p><b>Total - R<?php echo $_SESSION['reservation_meta']['total'] ;?></b></p>
                        <div class="form-group col-md-12">
                            <div class="spacer"></div>
                            <br/>
                            <button id="buttonCheckoutForm" type="submit" class="btn btn-primary btn-lg btn-block">Complete Reservation</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<?php
    include 'includes/footer.php';
?>
