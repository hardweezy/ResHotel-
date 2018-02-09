<?php
class Authenticate

	{
	/**
	 * [register save new user record in DB]
	 * @param  [string] $name     [$_POST]
	 * @param  [string] $email    [$_POST]
	 * @param  [string] $password [$_POST]
	 * @return [boolean]           [true]
	 */
	public function register($name, $email, $password)
		{
		$sql = DB::insert('users', array(
			'name' => $name,
			'email' => $email,
			'password' => $this->passwordHash($password) ,
			'created_at' => CarbonCarbon::now() ,
			'updated_at' => CarbonCarbon::now()
		));
		/**
		 *Check If the above query runs,
		 *if it does, a new record has been created
		 */
		if ($sql)
			{
			/**
			 * [$last_id description]
			 * @var [int]
			 * @return last inserted id
			 */
			$last_id = DB::insertId();
			/**
			 * [$afterRegistering description]
			 * @var [boolean]
			 * @return true if successfully logged in
			 */
			$login = $this->afterRegistering($email, $password);
			/**
			 * if login returns true, set Session and
			 * allow user to be redirected to Admin Dashboard
			 */
			if ($login)
				{
				$helper = new Helper();
				$helper->sessionSet($last_id, $name, $email);
				}
			}

		return true;
		}

	/**
	 * [afterRegistering call this method after registering user]
	 * @param  [string] $email
	 * @param  [hashed] $password
	 * @return [boolean]
	 */
	public function afterRegistering($email, $password)
		{
		if (password_verify($password, $this->fetchPassword($email)))
			{
			$sql = DB::queryFirstRow("SELECT * FROM users where email=%s and password=%s LIMIT 1", $email, $this->fetchPassword($email));
			if ($sql)
				{
				return true;
				}
			}
		}

	/**
	 * [login description]
	 * @param  [type] $email    [accepts email]
	 * @param  [type] $password [accepts string as password]
	 * @return [type]           [true if both fields validate]
	 */
	public function login($email, $password)
		{
		if (password_verify($password, $this->fetchPassword($email)))
			{
			$sql = DB::queryFirstRow("SELECT * FROM users where email=%s LIMIT 1", $email);
			if ($sql)
				{
				$helper = new Helper();
				$helper->sessionSet($sql['id'], $sql['name'], $sql['email']);
				return true;
				}
			}
		  else
			{
			return false;
			}
		}

	/**
	 * [passwordHash description]
	 * @param  [string] $password [accepts string as password]
	 * @return [hash]           [hashed version of password]
	 */
	public function passwordHash($password)
		{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
		}

	/**
	 * [fetchPassword description]
	 * @param  [string] $email [takes email]
	 * @return [hash]        [pasword (hashed)]
	 */
	public function fetchPassword($email)
		{
		$sql = DB::queryFirstField("SELECT password FROM users WHERE email=%s LIMIT 1", $email);
		if ($sql)
			{
			return $sql;
			}
		  else
			{
			return false;
			}
		}

	/**
	 * [validateEmail checks if email used to register is unique]
	 * @param  [string] $email [pass email]
	 * @return [boolean]        [returns true]
	 */
	public function validateEmail($email)
		{
		$sql = DB::queryFirstField("SELECT email FROM users where email=%s", $email);
		if ($sql)
			{
			return true;
			}
		}

	public function logout()
	{
			$helper = new Helper();

			$_SESSION = array();
			if (ini_get("session.use_cookies")) {
			    $params = session_get_cookie_params();
			        setcookie(session_name(), '', time() - 42000,
			        $params["path"], $params["domain"],
			        $params["secure"], $params["httponly"]
			    );
			}
			session_destroy();
			$helper->redirect('login.php');
			exit;
	}
}
