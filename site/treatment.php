<?php 
require "autoload.php";

if(isset($_POST)){
	define("SITE_KEY", "6Ld-P-EUAAAAAIQIfjaP8q71bcc_iKHe2xVVvEYM");
	define("SECRET_KEY", "6Ld-P-EUAAAAADKYPbU_-GhrZ66RtfsexvV08G6f");

	function getRecaptcha($secretKey){
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" .SECRET_KEY. "&response=".$secretKey);
		$return = json_decode($response);
		return $return;
	}

	if(isset($_POST["g-recaptcha-response"])){
		$return = getRecaptcha($_POST["g-recaptcha-response"]);
		if($return->success == true && $return->score > 0.5){
			$db = new DB();
			$visitor = new Visitor($_POST);

			$lastname = $visitor->lastName();
			$firstName = $visitor->firstName();
			$email = $visitor->email();
			$message = $visitor->message();

			if(!empty($lastname) && !empty($firstName) && !empty($email) && !empty($message)){
				if($visitor->mailValide($email)){
					$visitor->setIp($_SERVER["REMOTE_ADDR"]);
					$db->add($visitor);
				}else{
					unset($visitor);
				}
			}else{
				unset($visitor);
			}
		}			
	}else{
		header("Location: 404.php");
		exit;
	}

		
	
}else{
	header("Location: 404.php");
	exit;
}
require "inc/footer.php";