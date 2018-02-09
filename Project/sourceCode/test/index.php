<?php
require_once '../core/init.php';

require '../includes/header.php';

echo json_encode($_SESSION['reservation']) ."<br/>"; 
echo json_encode($_SESSION['reservation_meta']);


echo $room->fetchBookingsJSON();

echo $carbon->now()->toDateString($_SESSION['reservation_meta']['arrival']);

echo $carbon->now()->toDateString($_SESSION['reservation_meta']['departure']);

?>





<?php

require '../includes/footer.php';
?>

