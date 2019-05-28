<?php
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['email']) && isSet($_POST['password']))
	{		
			if($csrf->isTokenValid($_POST['_csrf'])){
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'email'=>'required|valid_email|min_len,3',
					'password'=>'required|min_len,6'));

				$validated_data = $gump->run($_POST);

				if($validated_data == true)
				{
					if($auth->login($_POST['email'],$_POST['password']) == true)
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>'Login Valid. Redirecting now...'));
					} else {
						echo json_encode(array(
							'status'=>'fail',
							'message'=>'Invalid Email/Password'));						
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