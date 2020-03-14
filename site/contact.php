<?php 
require "inc/header.php";?>

<h1 id="contact-title" class="text-center">Contactez-moi</h1>

<div class="container">
	<div id="alert"></div>
	
	
	<form action="treatment.php" method="POST" id="form">
		<div class="form-group">
	    	<label for="lastname">Nom<span class="required">*</span> : </label>
	    	<input type="text" class="form-control" id="lastname" name="lastname" required placeholder="Dupont">
	  	</div>

		<div class="form-group">
	    	<label for="firstname">Prénom<span class="required">*</span> : </label>
	    	<input type="text" class="form-control" id="firstname" name="firstname" required placeholder="Maurice">
	  	</div>
		
		<div class="form-group">
	    	<label for="email">Adresse email<span class="required">*</span> : </label>
	    	<input type="email" class="form-control" id="email" name="email" required placeholder="nome@exemple.com">
	  	</div>
	  	
	  	<div class="form-group">
	    	<label for="message">Votre message<span class="required">*</span> : </label>
	    	<textarea class="form-control" id="message" name="message" required rows="3"></textarea>
	  	</div>
	  	
    	<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

	  	<div class="form-check mb-3">
			<input class="form-check-input" type="checkbox" required name="confirm" id="confirm">
			<label class="form-check-label" for="defaultCheck1">
			  Je consens à envoyer mes données personnelles qui ne seront jamais revendues ni utilisées à des fins commerciales.
			</label>
		</div>
	  	
	  	<button id="submit" type="submit" class="btn btn-dark mb-5">Envoyer</button>
	</form>
</div>

<script src="https://www.google.com/recaptcha/api.js?render=6Ld-P-EUAAAAAIQIfjaP8q71bcc_iKHe2xVVvEYM"></script>
		<script>
			grecaptcha.ready(function() {
			    grecaptcha.execute('6Ld-P-EUAAAAAIQIfjaP8q71bcc_iKHe2xVVvEYM', {action: 'homepage'}).then(function(token) {
			       if(document.querySelector("#g-recaptcha-response") != null){
			       		document.querySelector("#g-recaptcha-response").value = token;
					}
			    });
			});
		</script>
<?php
require "inc/footer.php";