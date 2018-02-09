<?php
require_once '../core/init.php';

if (!empty($_FILES))
	{
	$file = $_FILES["file"]["name"];
	$filetype = $_FILES["file"]["type"];
	$filesize = $_FILES["file"]["size"];
	$loc = dirname(__DIR__) . DIRECTORY_SEPARATOR . "public/uploads" . DIRECTORY_SEPARATOR;
	if (!is_dir($loc))
		{
		mkdir($loc, 0777);
		}

	if ($file && move_uploaded_file($_FILES["file"]["tmp_name"], $loc . $file))
		{
		$sql = DB::insert('uploads', array(
			'name' => $file,
			'size' => $filetype,
			'type' => $filesize,
			'room_id' => $_SESSION['room_number'],
			'created_at' => $carbon->now() ,
			'updated_at' => $carbon->now()
		));
		if ($sql)
			{
			echo json_encode(array(
				"status" => "upload_success",
				"message" => "Added image to this Room"
			));
			}
		  else
			{
			echo json_encode(array(
				'status' => 'upload_error',
				'message' => 'problem with this deletion'
			));
			}
		}
	}