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
    ?>
<div class="row">
    <div class="col-md-12">
        <?php include 'profile.php'; ?>
        <div class="col-md-10">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="text-center">Room Types<span class="glyphicon glyphicon-home pull-right"></span></h4>
                </div>
                <div class="panel-body">
                    <table id="loadRooms" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Rooms</th>
                                <th>Base Price</th>
                                <th>Adults(Max)</th>
                                <th>Children(Max)</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    /**
     * include the footer file
     * that contain all <script> elements
     */
    require '../includes/footer.php';
    ?>