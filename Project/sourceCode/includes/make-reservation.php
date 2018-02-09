<?php
require_once '../core/init.php';


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['id']))
	{		
			/**
			 * Check if CSRF Token is present in the submitted form
			 * if Present, Verify it is the same one as the one in 
			 * $_SESSION['_csrf'];
			 * @return true [<description>]
			 */

			if($csrf->isTokenValid($_POST['_csrf'])){
				/**
				 * Sanitize the $_POST array
				 * @return  sanitized Array
				 * Set the validation rules for this form
				 * id - Required, must be numeric
				 * @return true
				 */
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'id'=>'required|numeric'));

				/**
				 * [$validated_data runs a check on the Posted data with the
				 * validation rules]
				 * @var [array()]
				 * @return ture/false [<description>]
				 */
				$validated_data = $gump->run($_POST);

				if($validated_data == true)
				{
					/**
					 * If validation test returns ok,
					 * call the reservationSummary method to store data in 
					 * _SESSION['reservation']
					 */
					if($room->reservationSummary($_POST) == true)
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>'Almost done! kindly confirm your Reservation'));
					}
				}else{

					echo json_encode(array(
						'status'=>'failed_validation',
						'message'=>$gump->get_readable_errors(true)));
				}

			}else{
				$message= "Invalid token";
				echo json_encode(array("status"=>"error",
										"message"=>$message));
			}
	}

}