<?php
    require_once 'core/init.php';
    include 'includes/header.php';
    if(isset($_GET['arrival']) && isset($_GET['departure'])){
    ?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center">SELECTED ROOMS(S)</h4>
                </div>
                <div class="panel-body text-center" id="preSelectedSummary">
                    <p>
                        You are booking Room(s) <?php echo isset($_GET['roomCapacity']) ?  $_GET['roomCapacity'] : '0';?><br/>
                        <?php echo isset($_GET['adultCapacity']) ?  $_GET['adultCapacity'] : '0';?> Adult, <?php echo isset($_GET['childCapacity']) ?  $_GET['childCapacity'] : '0';?> Child
                    </p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-left">YOUR RESERVATION</h5>
                </div>
                <div class="panel-body">
                    <form class="form-inline" role="form" method="GET" action="res-bookings.php" id="checkAvailabilityForm" data-parsley-validate>
                        <div class="spacer"></div>
                        <!-- Name input-->
                        <div class="form-group col-md-12">
                            <label class="control-label line_up" for="name">ARRIVAL DATE</label><br/>
                            <div>
                                <input type="text" class="form-control input-lg" id="arrival" name="arrival" placeholder="Arrival Date" value="<?php echo isset($_GET['arrival']) ?  $_GET['arrival'] : '';?>"
                                    data-parsley-required
                                    data-parsley-pattern="/^\d{2}\/\d{2}\/\d{4}$/">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label line_up" for="name">DEPARTURE DATE</label><br/>
                            <div>
                                <input type="text" class="form-control input-lg" id="departure" name="departure" placeholder="Departure Date" value="<?php echo isset($_GET['departure']) ?  $_GET['departure'] : '';?>"
                                    data-parsley-required
                                    data-parsley-pattern="/^\d{2}\/\d{2}\/\d{4}$/">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label line_up" for="name">ROOMS</label><br/>
                            <div>
                                <select name="roomCapacity" id="roomCapacity" class="wide">
                                    <?php 
                                        $options = $helper->selectDropDown();
                                        foreach($options as $value=>$label): ?>
                                    <option value="<?php echo $value; ?>" <?php if (isset($_GET['roomCapacity'])){ if($_GET['roomCapacity'] == $value) {echo 'selected="selected"';}} ?>><?php echo $label; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label line_up" for="name">ADULTS</label><br/>
                            <div>
                                <select name="adultCapacity" id="adultCapacity" class="wide">
                                    <?php 
                                        $options = $helper->selectDropDown();
                                        foreach($options as $value=>$label): ?>
                                    <option value="<?php echo $value; ?>" <?php if (isset($_GET['adultCapacity'])){ if($_GET['adultCapacity'] == $value) {echo 'selected="selected"';}} ?>><?php echo $label; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label line_up" for="name">CHILDREN</label><br/>
                            <div>
                                <select name="childCapacity" id="childCapacity" class="wide">
                                    <?php 
                                        $options = $helper->selectDropDown();
                                        foreach($options as $value=>$label): ?>
                                    <option value="<?php echo $value; ?>" <?php if (isset($_GET['childCapacity'])){ if($_GET['childCapacity'] == $value) {echo 'selected="selected"';}} ?>><?php echo $label; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="spacer"></div>
                            <br/>
                            <button type="submit" class="btn btn-success btn-lg btn-block">Check Availability</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="preReservationSummary">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="text-center">MAKE A RESERVATION<span class="glyphicon glyphicon-home pull-right"></span></h4>
                </div>
                <div class="panel-body">
                    <section class="col-xs-12 col-sm-6 col-md-12">
                        <?php  
                            $results = $room->fetchRoomsFromSearch($_GET);
                                if(!is_null($results)):
                                foreach ($results as $result):?>
                        <article class="search-result row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <a href="#" title="Lorem ipsum" class="thumbnail"><img src="../public/uploads/<?php echo $result['upload_name']; ?>" alt="<?php echo $result['name']; ?>" /></a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <ul class="meta-search">
                                    <li><i class="fa fa-money" aria-hidden="true"></i> <span>R<?php echo $result['price']; ?></span></li>
                                    <li><i class="fa fa-user-plus" aria-hidden="true"></i> <span><?php echo $result['adult_max_capacity']; ?> Adult(s)</span></li>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> <span><?php echo $result['child_max_capacity']; ?> Children</span></li>
                                    <li><i class="fa fa-home" aria-hidden="true"></i> <span><?php echo $result['number_of_rooms']; ?> Room(s)</span></li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                                <h3><?php echo $result['name']; ?></h3>
                                <p><?php echo substr(strip_tags($result['description']), 0, 386); ?></p>
                                <div class="row col-md-12">
                                    <input type="hidden" id="childCapacity" name="childCapacity" value="<?php echo $_GET['childCapacity'] ?>">
                                    <input type="hidden" id="adultCapacity" name="adultCapacity" value="<?php echo $_GET['adultCapacity'] ?>">
                                    <button id="reserveNow" type="submit" class="btn btn-warning pull-right onReserveNow" data-id="<?php echo $result['id']; ?>">Reserve Now</button>
                                </div>
                            </div>
                            <span class="clearfix borda"></span>
                        </article>
                        <?php endforeach; 
                            else:?>
                        <div class="col-md-12">
                            <h5 class="lead text-center">No rooms matching your search criteria. Try again </h5>
                        </div>
                        <?php endif;?>
                    </section>
                </div>
            </div>
        </div>
        <form role="form" method="POST" action="checkout.php">
            <div class="col-md-9" style="display:none" id="reservationSummary">
            </div>
        </form>
    </div>
</div>
<?php
    include 'includes/footer.php';
    }
    else{
    $helper->redirect('../');
    }  ?>
