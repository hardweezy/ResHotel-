<?php
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isSet($_POST['email']) && isSet($_POST['name']))
	{		
			if($csrf->isTokenValid($_POST['_csrf'])){
				$_POST = $gump->sanitize($_POST);
				$gump->validation_rules(array(
					'name'=>'required|valid_name|min_len,6',
					'email'=>'required|valid_email|min_len,3',
					'password'=>'required|min_len,6'));

				$validated_data = $gump->run($_POST);

				if($validated_data == true)
				{
					if($auth->register($_POST['name'],$_POST['email'],$_POST['password']))
					{
						echo json_encode(array(
							'status'=>'success',
							'message'=>$_POST['name'].' has successfully been registered. Redirecting now...'));
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