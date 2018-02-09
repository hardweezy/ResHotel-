<?php
    include '../core/init.php';
    /**
     * checj if User SEsssion is active
     * if Yes allow to view this page
     * Else redirect to auth
     */
    if($helper->isLoggedIn() == false)
    {
        $helper->redirect('login.php');
    }
    /**
     * include the header file
     * that contain all <head> elements
     */
    require '../includes/header.php';

    if(isset($_GET['reservation'])):
    	$result = $room->fetchSingleBooking($_GET['reservation']);
    ?>
<div class="row">
    <div class="col-md-12">
        <?php include 'profile.php'; ?>
        <div class="col-md-10">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="text-center">Reservation<span class="glyphicon glyphicon-home pull-right"></span></h4>
                </div>
                <div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
        	<div class="invoice-title">
    			<h2>Bookings #<?php echo $result['reservations_id']; ?> details</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?php echo $result['fullname']; ?><br>
    					<?php echo $result['email_address']; ?><br>
    					<?php echo $result['cellphone']; ?><br>
    					<?php echo $result['home_address']; ?><br>
    					<?php echo $result['country']; ?>
    				</address>
    			</div>
    	
    			<div class="col-xs-3">
    				<address>
    					<strong>Room Details:</strong><br>
    					<b><?php echo $result['name']; ?></b><br>
    					<?php echo $result['number_of_rooms']; ?> Room(s) | R<?php echo $result['price']; ?>/night <br/>
    					<?php echo $result['adult_max_capacity']; ?> Adult(s) | <?php echo $result['child_max_capacity']; ?> Children <br/>

    					
    				</address>
    			</div>
    			<div class="col-xs-3 ">
    				<address>
    					<strong>Booking Date:</strong><br>
    					<?php echo date("F jS, Y", strtotime($result['created_at'])); ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Reservation Info</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td class="text-center"><strong>Arrival Date</strong></td>
        							<td class="text-center"><strong>Departure Date</strong></td>
        							        							<td class="text-center"><strong>Price/Night</strong></td>

        							        							<td><strong>Room(s)</strong></td>
        							<td class="text-center"><strong>Adult</strong></td>
        							<td class="text-center"><strong>Children</strong></td>

                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    							    								<td class="text-center"><?php echo date("F jS, Y", strtotime($result['date_in']));?></td>
    							    								<td class="text-center"><?php echo date("F jS, Y", strtotime($result['date_out']));?></td>
									    								<td class="text-center"><?php echo $result['price'].' x '.(((float)$result['amount_charged']) / ((float)$result['price'])); ?></td>

    								<td class="text-center"><?php echo $result['room_number']; ?></td>
    								<td class="text-center"><?php echo $result['adult_count']; ?></td>
    								<td class="text-center"><?php echo $result['child_count']; ?></td>
    							</tr>

    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-center"><b><?php echo $result['amount_charged']; ?></b></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
else:
$helper->redirect('viewbookings.php');
endif;
    /**
     * include the footer file
     * that contain all <script> elements
     */
    require '../includes/footer.php';
    ?>