<?php
    include '../core/init.php';
    if($helper->isLoggedIn() == false)
    {
        $helper->redirect('login.php');
    }
    require '../includes/header.php';
    ?>
<div class="row">
    <div class="col-md-12">
        <?php include 'profile.php'; ?>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="text-center">Add Room Type<span class="glyphicon glyphicon-home pull-right"></span></h4>
                </div>
                <div class="panel-body">
                    <form id="room_upload" data-parsley-validate>
                        <div class="control-group">
                            <label>Room Title</label>
                            <div class="controls">
                                <input type="text" class="form-control" placeholder="Enter title here" name="roomName" id="roomName" 
                                    data-parsley-required-message="room name is required"
                                    data-parsley-trigger="change focusout"
                                    data-parsley-required
                                    data-parsley-minlength="3" required autofocus>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="control-group">
                            <div class="controls">
                                <textarea class="form-control textarea" rows="7" name="roomDescription" id="roomDescription" placeholder="describe this room.."  data-parsley-required-message="room description is required"
                                    data-parsley-trigger="change focusout"
                                    data-parsley-required
                                    data-parsley-minlength="6" required autofocus></textarea>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="text-left">Room Data</h5>
                            </div>
                            <div class="panel-body">
                                <div class="spacer"></div>
                                <!-- Name input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label line_up" for="name">Number of rooms *</label>
                                    <div class="col-md-8">
                                        <select name="numberOfRooms" id="numberOfRooms">
                                            <?php 
                                                $options = $helper->selectDropDown();
                                                foreach($options as $value=>$label): ?>
                                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="spacer spacer_height"></div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label line_up" for="name">Base Price *</label>
                                    <div class="col-md-8">
                                        <select name="priceRoom" id="priceRoom">
                                            <option value="600">R 600</option>
                                            <option value="800">R 800</option>
                                            <option value="1000">R 1000</option>
                                            <option value="1200">R 1200</option>
                                            <option value="1500">R 1500</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="spacer spacer_height"></div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label line_up" for="name">Adult Sleeping Capacity*</label>
                                    <div class="col-md-8">
                                        <select name="adultMaxCapacity" id="adultMaxCapacity">
                                            <?php 
                                                $options = $helper->selectDropDown();
                                                foreach($options as $value=>$label): ?>
                                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="spacer spacer_height"></div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label line_up" for="name">Child Sleeping Capacity*</label>
                                    <div class="col-md-8">
                                        <select name="childMaxCapacity" id="childMaxCapacity">
                                            <?php 
                                                $options = $helper->selectDropDown();
                                                foreach($options as $value=>$label): ?>
                                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $csrf->echoInputField() ?>
                    </form>
                    <div class="spacer"></div>
                    <div class="panel panel-primary" style="display:none" id="imagegallery">
                        <div class="panel-heading">
                            <h5 class="text-left">Room Gallery</h5>
                        </div>
                        <div class="panel-body">
                            <form id="my-awesome-dropzone" class="dropzone" action="uploads.php">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-left">Publish</h4>
                </div>
                <div class="panel-body">
                    <button id="addRoom" type="submit" class="btn btn-primary">Publish Room</button>
                    <a href="index.php" id="gotoRooms" type="submit" class="btn btn-success" style="display:none">View Rooms</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require '../includes/footer.php';
    ?>