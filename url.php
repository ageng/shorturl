<?php
	require_once("func.inc.php");

	if (isset($_POST['url_php'])){
		$url = trim($_POST['url_php']);
		if (empty($url)){
			echo 'error_no_url';
		}
		else if (filter_var($url, FILTER_VALIDATE_URL) === false){
			echo 'error_invalid_url';
		}
		else if (is_mx($url)){
			echo 'error_is_mx';
		}
		else{
			while (!code_exists($code = gen_code())){
				echo 'http://localhost/short-url/'.shorten($url, $code);
				break 1;
			}
		}
	}
?>
