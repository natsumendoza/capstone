<?php 
include 'user_session.php';
include 'check_login.php';
include '../../include/connectdb.php';
$fname="";
if(user_session()){
	$query = mysql_query("SELECT * FROM users WHERE fname='$_SESSION[user]' ");
	while ($row = mysql_fetch_assoc($query))
					{
						$userid = $row ['id'];
						$email = $row ['email'];
						$fname = $row ['fname'];
					}
	 
}
else{
echo 'cannot modify session';	
}
?>

<?php 
$user1="";
$admin="Administrator";
include '../../include/connectdb.php';
if(isset($_GET['user']) && isset($_GET['message'])) {
  if(trim($_GET['user']) != "" && trim($_GET['message']) != "") {
    $message = strip_tags(mysql_real_escape_string(trim($_GET['message'])));  
    $admin    = 'Administrator'; 
	$user    = strip_tags(mysql_real_escape_string(trim($_GET['user'])));
        
		 $user1 =$user;

    $s = "INSERT INTO chat(user,message,member_name,date) VALUES ('$admin', '$message','$user',NOW())";
    $q = mysql_query($s) or die(mysql_error());
	
	

  }
}
        
  $s = "SELECT * FROM chat WHERE (DAY(date) = DAY(CURDATE()) AND MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())) ORDER BY date DESC";
  $q = mysql_query($s) or die(mysql_error());  
 
        
?>

<?php while($r = mysql_fetch_array($q)) {
	if($r['user'] == $fname) $user_bg = '<h2 class="user">'.$r['user'].'</h2>'; else $user_bg = '<h2 class="admin">'.$r['user'].'</h2>';  
  if($r['user'] == $fname || $r['member_name']== $fname) {
?>
<?php 
	
	echo'<div class="messaging1">
    '.$user_bg .'
    <p class="time">'.date('g:i:s a', strtotime($r['date'])).'</p>
    <p>'.$r['message'].'
</div>';
	}
}
?>
<?php 

/* if($r['member_name']==$user1)
echo'<div class="messaging1">
    <h2 class="user">'.$r['user'].'</h2>
    <p class="time">'.date('g:i:s a', strtotime($r['date'])).'</p>
    <p>'.$r['message'].'
</div>';
else{
	}
*/
?>