<div class="col-md-2">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="text-center">User Profile<span class="glyphicon glyphicon-user pull-right"></span></h4>
        </div>
        <div class="panel-body text-center">
            <p class="lead">
                <strong><?php echo $_SESSION['name'] ?></strong>
            </p>
        </div>
        <ul class="list-group">
            <li class="list-group-item"><strong><i class="fa fa-envelope-o" aria-hidden="true"></i></strong>
                <span class="pull-right"><?php echo $_SESSION['email'] ?></span>
            </li>
            <li class="<?php $helper->echoActiveClass("index"); ?> list-group-item"><strong><a href="index.php">All Rooms</a></strong>
            </li>
            <li class="<?php $helper->echoActiveClass("addroom"); ?> list-group-item"><strong><a href="addroom.php">Add Room Type</a></strong>
            </li>
            <li class="<?php $helper->echoActiveClass("viewbookings"); ?> list-group-item"><strong><a href="viewbookings.php">Bookings</a></strong>
            </li>
            <li class="list-group-item"><strong><a href="#">Settings</a></strong>
            </li>
            <li class="list-group-item"><strong><i class="fa fa-power-o" aria-hidden="true"></i></strong>
                <span class="pull-right"><i class="fa fa-power-off" aria-hidden="true"></i> <a href="logout.php">Logout </a></span>
            </li>
        </ul>
    </div>
</div>