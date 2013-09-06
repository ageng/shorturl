<?php
  require_once("func.inc.php");

	if(isset($_GET['code']) && !empty($_GET['code'])){
		$code = $_GET['code']; // get the code. We do not get it from the url on this format: http://blablab?code=.... , because we have .htaccess rules for this and we get it like this: http://blablal/....
		redirect($code); // call the function redirect with the parameter $code generated from the shortener
		exit(); // safety for header, because some browsers do not accept headers
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
	<head>
		<title>Url Shortner</title>
		<link href="style.css" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js" /></script>
		<script type="text/javascript">
			$(document).ready(function() {/* when page is ready focus to the field so the user can key in, right away */
				$('#url').focus();
			});

			function go(url) { /* It gets executed as soon as the user clicks "Shorten" or he hits enter */
				$.post('url.php', { url_php/* url in php file */: url/* url in this file */ }, function(data){ /* post the keyed in text to url.php */
					if (data == 'error_no_url'){/* if the data returned by php file equals this output */
						$('#message').html('<p><strong>Please input your URL</strong></p>').css("color","red"); /* show this message to the user, on the <div id="message"> tag */
					}
					else if (data == 'error_invalid_url'){/* if the data returned by php file equals this output */
						$('#message').html('<p><strong>URL must use http://</strong></p>').css("color","red");
					}
					else if (data == 'error_is_mx'){/* if the data returned by php file equals this output */
						$('#message').html('<p><strong>URL already shortner</strong></p>').css("color","red");
					}
					else{/* if nothing of the previous actions happen, execute this */
						$('#url').val(data); /* fill the url text field with data returned from php file, by setting the value of the 'url' with value from 'data' */
						$('#url').select(); /* select the text in the url input field */
						$('#message').html('<p><strong>Your URL is shortner </strong></p>').css("color","green"); /* show this message to the user, on the <div id="message"> tag*/
					}
				});
			}
		</script>
	</head>
	<body>
		<div id="container">
		  <h1>Pemendek Tautan yang ganteng !</h1>
		  <!-- If the user hits enter or clicks "Shorten" the go() function will be executed -->
		  <p><input type="text" name="url" id="url" size="60" onkeydown="if (event.keyCode == 13 || event.which == 13) { go($('#url').val()); }" /> <input type="button" value="Shorten" onclick="go($('#url').val());" /></p>

		  <div id="message"><p>&nbsp;</p></div> <!-- Messages will be shown here, using the id="message" by $('#message') -->
		  <div id="copyright"><p>Newbiemasih@ <?php echo date('Y'); ?></p></div>
		  </div>
	</body>
</html>
