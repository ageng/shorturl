<?php

  require_once("db.inc.php");

	function is_mx($url){
		return (preg_match("/localhost\.short/i", $url)) ? true : false;

	function gen_code(){
		$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		return substr(str_shuffle($charset), 0, 2); /* shuffle the characters and choose from the first one(0) with 6 length code */
	}

	function code_exists($code){
		$code = mysql_real_escape_string($code); /* provide some security */
		$code_exists = mysql_query("SELECT COUNT('url_id') FROM urls WHERE code='$code' LIMIT 1"); /* count the url_id's with the code provided from gen_code() */
		return (mysql_result($code_exists, 0) == 1) ? true : false; // if the code exists in the DB we return true, otherwise we return false
	}

	function shorten($url, $code) {
		$url  = mysql_real_escape_string($url); /* provide security here */
		$code  = mysql_real_escape_string($code);
		mysql_query("INSERT INTO urls VALUES ('', '$url', '$code')");  //insert query
		return $code; //return the code so it will be echoed to the user
	}

	function redirect($code){ //the code to redirect the user to the shortened page
		$code = mysql_real_escape_string($code); //get the code
		if (code_exists($code)){ // if the code exists in DB
			$url_query = mysql_query("SELECT url FROM urls WHERE code='$code'"); // select the url from the DB where the code equals to the code we enter in the url
			$url = mysql_result($url_query, 0, 'url'); // result the query and get data starting from row 0 in table.fielname url in DB
			header('Location: '.$url); // redirect the user to the url grabbed from DB with the specific code we got from shortening
		}
	}

?>
