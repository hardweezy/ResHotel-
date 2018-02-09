<?php
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['guestEmail']) && isSet($_POST['_csrf']))
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
				 * First Name Rules - Required, Alpha characters, Minimum length of 3
				 * Last name - Required, Valid Characters
				 * Email - Required, valid Email, minimum length of 3 [<description>]
				 * @return true [type]
				 */
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'guestFirstName'=>'required|valid_name|min_len,3',
					'guestLastName'=>'required|valid_name|min_len,3',
					'guestEmail'=>'required|valid_email|min_len,3'));

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
					 * call the checkoutReservation method
					 * @return true
					 */
					$reservationID = $room->checkoutReservation($_POST);
					if(!is_null($reservationID))
					{
						
						echo json_encode(array(
							'status'=>'success',
							'message'=>'Your reservation #'.$reservationID .' is confirmed, Kindly check your inbox for more details.  Redirecting Now....'));
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

?>