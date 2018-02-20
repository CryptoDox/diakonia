<form action="D.php" method="post">
	<!-- other form fields -->

	<script src="https://coinhive.com/lib/captcha.min.js" async></script>
	<script>
		function myCaptchaCallback(token) {
			alert('Hashes reached. Token is: ' + token);
		}
	</script>
	<div class="coinhive-captcha" 
		data-hashes="1024" 
		data-key="ijfygbxwHMzFcIpljkU3WVpwRkLkuGmD"
		data-autostart="false"
		data-whitelabel="false"
		data-disable-elements="input[type=submit]"
		data-callback="myCaptchaCallback"
	>
		<em>Loading Captcha...<br>
		If it doesn't load, please disable Adblock!</em>
	</div>

	<!-- submit button will be automatically disabled and later enabled
		again when the captcha is solved -->
	<input type="submit" value="Valider"/>
	$reg_form->addElement(new XoopsFormButton('', 'submit', _US_SUBMIT, 'submit'));
</form>