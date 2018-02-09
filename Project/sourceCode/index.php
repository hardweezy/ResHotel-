<?php
    require_once 'core/init.php';
    include 'includes/header.php';
    
    include 'includes/slider.php';
    ?>
<div class="col-md-12 text-center checkAvailability" style="background-color: #344A71; padding:30px;">
    <form class="form-inline" role="form" method="GET" action="res-bookings.php" id="checkAvailabilityForm" data-parsley-validate>
        <div class="form-group">
            <input type="text" class="form-control input-lg" id="arrival" name="arrival" placeholder="Arrival Date" 
                data-parsley-required
                data-parsley-pattern="/^\d{2}\/\d{2}\/\d{4}$/">
        </div>
        <div class="divider"></div>
        <div class="form-group">
            <input type="text" class="form-control input-lg" id="departure" name="departure" placeholder="Departure Date" 
                data-parsley-required
                data-parsley-pattern="/^\d{2}\/\d{2}\/\d{4}$/">
        </div>
        <div class="divider"></div>
        <div class="form-group">
            <select name="roomCapacity" id="childMaxCapacity" data-parsley-required>
                <option value="">Rooms</option>
                <?php 
                    $options = $helper->selectDropDown();
                    foreach($options as $value=>$label): ?>
                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="divider"></div>
        <div class="form-group">
            <select name="adultCapacity" id="adultMaxCapacity" data-parsley-required>
                <option value="">Adults</option>
                <?php 
                    $options = $helper->selectDropDown();
                    foreach($options as $value=>$label): ?>
                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="divider"></div>
        <div class="form-group">
            <select name="childCapacity" id="childMaxCapacity" data-parsley-required>
                <option value="">Children</option>
                <?php 
                    $options = $helper->selectDropDown();
                    foreach($options as $value=>$label): ?>
                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="divider"></div>
        <button id="homeCheckAvailability"type="button" class="btn btn-success btn-lg">Check Availability</button>
    </form>
</div>
<div class="col-md-12">
    <div class="spacer spacer_height"></div>
    <div class="col-md-4">
        <div style="padding:100px">
            <div style="color:#232323;">
                <h2>OUR ROOMS &amp; RATES</h2>
                <div class="awe-subheading below">
                    <p>We hope that you will locate your dream accommodation with just few “clicks”.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <?php 
            $rooms = $room->fetchRooms();
            
            /**
             * this echo out the top 4 rooms from the created
             * Room Types
             * Returns associative array
             */
            if(!is_null($rooms)):
            
            foreach ($rooms as $room): ?>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="thumbnail">
                <img class="img-responsive" src="../public/uploads/<?php echo $room['upload_name']; ?>" alt="<?php echo $room['name']; ?>" style="width:500px;height: 300px">
                <div class="caption">
                    <h4><?php echo $room['name']; ?></h4>
                    <p><b>Price</b> from R<?php echo $room['price']; ?>/night | <b>Adults</b> <?php echo $room['adult_max_capacity']; ?> | <b>Children</b> <?php echo $room['child_max_capacity']; ?></p>
                </div>
            </div>
        </div>
        <?php endforeach;
            else: ?>
        <div class="col-md-12">
            <h5 class="lead text-center">We are still busy creating our Rooms for public viewing. We will be back with suprises.</h5>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php
    include 'includes/footer.php';
    ?>