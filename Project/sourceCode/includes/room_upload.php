<?php
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['roomName']) && isSet($_POST['roomDescription']))
	{		
			if($csrf->isTokenValid($_POST['_csrf'])){
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'roomName'=>'required|min_len,6',
					'roomDescription'=>'required|min_len,3'));
				$validated_data = $gump->run($_POST);

				if($validated_data == true)
				{
					$returnd = $room->addNewRoom($_POST);
					if(!is_null($returnd))
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>'Room #'.$returnd.' created'));
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