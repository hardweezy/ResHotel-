<?php
/**
 * Session starts at this line, could be empty at this phase
 */
session_start();
/**
 * Autoload all 3rd party php libraries to help speed up dev.
 * file loaded
 * 
 * Carbon - A simple PHP API extension for DateTime. 
 * 
 * MeekroDB - MeekroDB is a PHP MySQL library that lets you get more 
 * done with fewer lines of code, and makes SQL injection 100% impossible.
 * 
 * GUMP - A fast, extensible & stand-alone PHP input validation class 
 * that allows you to validate any data
 * 
 * PasswordCompact - A library for generating and validating password HASH
 */
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor/autoload.php';
/**
 * Autoload all Class files in the project_root/class folder
 * No need to add the class in all files
 */
spl_autoload_register(function($class){
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'class/'.$class.'.php';
});

/**
 * Initiate and set-up Database information.
 * this libraray won't establish connection until a query runs
 * @var 
 * @return  DB connection instance
 */
DB::$host = 'localhost';
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'reshotelsystem';


$helper = new Helper();
$csrf = new CSRF_Protect();
$gump = new GUMP();
$carbon = new Carbon\Carbon();
$auth = new Authenticate();
$room = new Room();

