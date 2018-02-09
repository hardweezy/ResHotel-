<?php 
require_once '../core/init.php';

if(isSet($_SESSION['reservation'])):
?>


<div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="text-center">RESERVATION SUMMARY<span class="glyphicon glyphicon-home pull-right"></span></h4>
                </div>
                <div class="panel-body">
					                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive" src="../public/uploads/<?php echo $_SESSION['reservation']['upload_name']; ?>" style="width:100px;height:100px">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="room-name"><strong><?php echo $_SESSION['reservation']['name']; ?></strong></h4>
                            <h4><small><?php echo $_SESSION['reservation_meta']['roomsCount']; ?> Room(s), <?php echo $_SESSION['reservation_meta']['adultCapacity']; ?> Adult, <?php echo $_SESSION['reservation_meta']['childCapacity']; ?> Child</small></h4>
                            <h4><small><?php echo $_SESSION['reservation_meta']['arrival']; ?> - <?php echo $_SESSION['reservation_meta']['departure']; ?></small></h4>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6 text-right">
                                <h4 class="room-name"><strong>PRICE</strong></h4>
                                <h6><strong> <?php echo $_SESSION['reservation_meta']['dateDiff']; ?> Nigths <span class="text-muted">x</span></strong></h6>
                                <h6><strong> R <?php echo $_SESSION['reservation']['price']; ?> </strong></h6>
                            </div>
                            <div class="col-xs-6 text-right">
                                <h4 class="room-name"><strong>TOTAL</strong></h4>
                                <h6><strong> R <?php echo $_SESSION['reservation_meta']['total']; ?> </strong></h6>
                            </div>
                        </div>
                        <div class="row col-md-12">
							                        <button type="submit" class="btn btn-success pull-right">Place Booking</button>

                        </div>
                    </div>
                </div>
            </div>

<?php endif; ?>