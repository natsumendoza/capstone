<?php 
include 'include/check_login.php';
include '../include/connectdb.php';
?>
<?php
	$error ='';
	$error2='';
if (isset($_POST['login']))
{
	//get data
	$username = addslashes(strip_tags($_POST['username']));
	$password = addslashes(strip_tags($_POST['password']));
	$logintime = date('d/m/Y - H:ia');
	
	if ($username&&$password)
	{
				$login = mysql_query("SELECT * FROM admin WHERE username='$username'");//filtering the database and compare if the username macth the variable inputed in the username field.
				
				if (mysql_num_rows($login)!=0)
				{
					//code to login
					while ($row = mysql_fetch_assoc($login))
					{
						$dbpassword = $row ['password'];
						$password = md5($password);
						
						if ($password != $dbpassword){
							$error = '<div class="alert alert-error fg-crimson"><span class="mif-warning mif-ani-flash mif-ani-slow mif-2x"></span> Incorrect username or password</div>';
							    
							}
					
						else
						{
						$_SESSION['manager']=$username;
						
								header("Location:index.php");
								exit();
								}
					}
				}
				else
				{
				$error = '<div class="alert alert-error fg-crimson"><span class="mif-blocked mif-ani-horizontal mif-ani-slow mif-2x"> </span> That user doesnt exist!</div>';
						
				}			
	}
	else
	$error = '<div class="alert alert-error fg-orange"><span class="mif-pencil mif-ani-float mif-ani-fast mif-2x"> </span> Please enter a username and password</div>';
			
			

			}
			
			

?>
<!DOCTYPE html>
<head>
<?php include 'template/style.php' ?>
<head lang="en">

    <title>Capstone101 | Admin Login</title>
<style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>
    <script>
        /*
        * Do not use this is a google analytics fro Metro UI CSS
        * */
        if (window.location.hostname !== 'localhost') {

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-58849249-3', 'auto');
            ga('send', 'pageview');

        }


        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body class="bg-darkTeal">
    <div class="login-form padding20 block-shadow">
        
	    
     <form action="" class="login active"  method="post"  >
            <center><h2 class="text-light">Welcome back Admin!</h2>
			<div id="status2"><?php echo $error?></div><!--for login status output-->
			</center>
            <hr class="thin"/>
            <br />			
            <div class="input-control text full-size" data-role="input">
                <label for="exampleInputPassword">Admin Name:</label>
                <input type="text" name="username" id="username" placeholder="Adminname">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="exampleInputEmail">Admin password:</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
			 <div class="clearfix"></div>
            <div class="form-actions">
			<input type="hidden" name="save" value="contact">
                <button type="submit" value="Login" name="login" class="button primary">Submit</button>
                <button type="button" class="button link">Cancel</button>
            </div>
        </form>
    </div>

    <!-- hit.ua -->
    <a href='http://hit.ua/?x=136046' target='_blank'>
        <script language="javascript" type="text/javascript"><!--
        Cd=document;Cr="&"+Math.random();Cp="&s=1";
        Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
        Cp+="&t="+(new Date()).getTimezoneOffset();
        if(self!=top)Cp+="&f=1";
        //--></script>
        <script language="javascript1.1" type="text/javascript"><!--
        if(navigator.javaEnabled())Cp+="&j=1";
        //--></script>
        <script language="javascript1.2" type="text/javascript"><!--
        if(typeof(screen)!='undefined')Cp+="&w="+screen.width+"&h="+
        screen.height+"&d="+(screen.colorDepth?screen.colorDepth:screen.pixelDepth);
        //--></script>
        <script language="javascript" type="text/javascript"><!--
        Cd.write("<img src='http://c.hit.ua/hit?i=136046&g=0&x=2"+Cp+Cr+
        "&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
        "' border='0' wi"+"dth='1' he"+"ight='1'/>");
        //--></script></a>
    <!-- / hit.ua -->
</body>
</html>