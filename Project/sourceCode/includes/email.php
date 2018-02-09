<?php

require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{

	if(isSet($_POST['email']))
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
				 * Email - Required, Valid Email Address
				 * @return true [type]
				 */
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'email'=>'required|valid_email|min_len,3'));

				/**
				 * [$validated_data runs a check on the Posted data with the
				 * validation rules]
				 * @var [array()]
				 * @return ture/false [<description>]
				 */
				$validated_data = $gump->run($_POST);

				if($validated_data == true){

					if($auth->validateEmail($_POST['email']) == true)
					{
							echo json_encode(array(
							'status'=>'found',
							'message'=>$_POST['email'].' exist already. Use another'));

					}else{
							echo json_encode(array(
							'status'=>'not_found',
							'message'=>$_POST['email'].' is available for use'));
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