<!DOCTYPE HTML>
<html lang="en">
<head>
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 13px;
		}
		.info, .success, .warning, .error, .validation {
			border: 1px solid;
			margin: 10px 0px;
			padding: 15px 10px 15px 50px;
			background-repeat: no-repeat;
			background-position: 10px center;
		}
		.info {
			color: #00529B;
			background-color: #BDE5F8;
		}
		.success {
			color: #4F8A10;
			background-color: #DFF2BF;
		}
		.warning {
			color: #9F6000;
			background-color: #FEEFB3;
		}
		.error{
			color: #D8000C;
			background-color: #FFBABA;
		}
		.validation{
			color: #D63301;
			background-color: #FFCCBA;
		}
	</style>
</head>
<body>
<div class="validation"><?php  echo isset($_SESSION['error_message']) ? $_SESSION['error_message']  :  '404! Not Found'; ?></div>
</body>
</htm>