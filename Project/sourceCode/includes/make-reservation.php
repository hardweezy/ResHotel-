<?php
require_once '../core/init.php';


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['id']))
	{		
			if($csrf->isTokenValid($_POST['_csrf'])){
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'id'=>'required|numeric'));

				$validated_data = $gump->run($_POST);

				if($validated_data == true)
				{
					if($room->reservationSummary($_POST) == true)
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>'Almost done! kindly confirm your Reservation'));
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