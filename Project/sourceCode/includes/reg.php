<?php
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['email']) && isSet($_POST['name']))
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
				 * Name Rules - Required, Alpha characters, Minimum length of 3
				 * Email - Required, Valid Email Address
				 * Password - Required, minimum length of 6 [<description>]
				 * @return true [type]
				 */
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'name'=>'required|valid_name|min_len,6',
					'email'=>'required|valid_email|min_len,3',
					'password'=>'required|min_len,6'));

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
					 * call the register method to store data in 
					 * DB
					 */
					if($auth->register($_POST['name'],$_POST['email'],$_POST['password']))
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>$_POST['name'].' has successfully been registered. Redirecting now...'));
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