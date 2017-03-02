 
  <?php
  
  if(isset($_POST['submit'])){
  require_once('recaptchalib.php');
  $privatekey = "6LdrStgSAAAAAGDWwZqNOVOADLbXe07PNicrY5vB";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
   
		 echo"The reCAPTCHA wasn't entered correctly!!";
  } else {
    // Your code here to handle a successful verification
	echo"You Entered Corectly!!";
  }
  }
  ?>
 
 
 <html>
    <body> <!-- the body tag is required or the CAPTCHA may not show on some browsers -->
      <!-- your HTML content -->
      

 <form method="post" action="recaptcha.php">
        <?php
          require_once('recaptchalib.php');
          $publickey = "6LdrStgSAAAAAETR2sIGgZOAQ0w1rEw1vsWTXtBH "; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
        <input type="submit" name="submit"/>
      </form>

      <!-- more of your HTML content -->
    </body>
  </html>