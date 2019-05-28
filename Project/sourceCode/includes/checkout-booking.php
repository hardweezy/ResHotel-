<?php
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['guestEmail']) && isSet($_POST['_csrf']))
	{		
			if($csrf->isTokenValid($_POST['_csrf'])){
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'guestFirstName'=>'required|valid_name|min_len,3',
					'guestLastName'=>'required|valid_name|min_len,3',
					'guestEmail'=>'required|valid_email|min_len,3'));

				$validated_data = $gump->run($_POST);

				if($validated_data == true)
				{
					$reservationID = $room->checkoutReservation($_POST);
					if(!is_null($reservationID))
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>'Your reservation #'.$reservationID .' is confirmed, Kindly check your inbox for more details.  Redirecting Now....'));
					}
				} else {
					echo json_encode(array(
						'status'=>'failed_validation',
						'message'=>$gump->get_readable_errors(true)));
				}
			} else {
				$message= "Invalid token";
				echo json_encode(array("status"=>"error",
										"message"=>$message));
			}
	}
}

?>