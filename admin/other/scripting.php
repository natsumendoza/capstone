<script type="text/javascript">
	$(document).ready(function(){
		$('.carousel').carousel({
  				interval: 2000
		})     
    });
	  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
<script language="JavaScript" type="text/javascript">
//////for register ajax
function ajax_register(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "register.php";
	var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
	var repeat = document.getElementById("repeat").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
	var month = document.getElementById("month").value;
	var day = document.getElementById("day").value;
	var year = document.getElementById("year").value;
	var address = document.getElementById("address").value;
	var contact = document.getElementById("contact").value;
	var recaptcha_challenge_field = document.getElementById("recaptcha_challenge_field").value;
	var recaptcha_response_field = document.getElementById("recaptcha_response_field").value;
	 
	 var vars = "email="+email+"&password="+password+"&repeat="+repeat+"&fname="+fname+"&lname="+lname+"&month="+month+"&day="+day+"&year="+year+"&address="+address+"&contact="+contact+"&recaptcha_challenge_field="+recaptcha_challenge_field+"&recaptcha_response_field="+recaptcha_response_field;
	
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("register").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("register").innerHTML = "<img src='img/ajax-loader.gif' />Processing...";
}

function ajax_forgot(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "forgot.php";
    var email = document.getElementById("forgotemail").value;
	 //var vars = "username="+user+"&password="+pass;
    var vars = "email="+email;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("forgotpass").innerHTML = return_data;
			
	    }	
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("forgotpass").innerHTML = "<img src='img/ajax-loader.gif' /> processing...";
}

function ajax_contact(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "contact.php";
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
	var email = document.getElementById("email").value;
	var message= document.getElementById("message").value;
	 //var vars = "username="+user+"&password="+pass;
    var vars = "fname="+fname+"&lname="+lname+"&email="+email+"&message="+message;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("status").innerHTML = return_data;
			
	    }	
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("status").innerHTML = "<img src='img/ajax-loader.gif' /> processing...";
}
//////for login ajax
function ajax_login(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "login.php";
    var user = document.getElementById("emailadd").value;
    var pass = document.getElementById("pass").value;
    var vars = "emailadd="+user+"&password="+pass;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("status2").innerHTML = return_data;
			//window.location.reload(true);
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("status2").innerHTML = "<img src='img/ajax-loader.gif' />";
}
</script>
<script type="text/javascript">
$("#forgot").click(function() {
$('#login').modal('hide')
$('#forgot').modal('show')    
});
</script>