<!DOCTYPE html>
<?php 
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['databasename'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $databasename = trim($_POST['databasename']);
        $backupRestore = $_POST['backupRestore'];
 
        if ($backupRestore == 'backup'){        
            $data = $_POST['data'];
            $now = str_replace(":", "", date("Y-m-d H:i:s"));
            $outputfilename = $databasename . '-' . $now . '.sql';
            $outputfilename = str_replace(" ", "-", $outputfilename);
 
            //Dump the MySQL database
            if ($data == "wd"){
                //With data
                exec('mysqldump -u '. $username .' -p'. $password .' '. $databasename .' > '. $outputfilename);
            }
            else{
                //Without data
                exec('mysqldump --no-data  -u '. $username .' -p'. $password .' '. $databasename .' > '. $outputfilename);
            }   
 
            //Download the database file
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($outputfilename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($outputfilename));
            ob_clean();
            flush();
            readfile($outputfilename);
         
            //After download remove the file from server
            exec('rm ' . $outputfilename);  
 
        }
        else{//Restore the database
 
            $target_path = getcwd();
            $databasefilename = $_FILES["databasefile"]["name"];
 
            //Upload the database file to current working directory
            move_uploaded_file($_FILES["databasefile"]["tmp_name"], $target_path . '/' . $databasefilename);
 
            //Restore the database          
            exec('mysql -u '. $username .' -p'. $password .' '. $databasename .' < '. $databasefilename);
             
            //Remove the file from server
            exec('rm ' . $databasefilename);
        }
    }
?>
<html>
    <head>
        <title>MySQL database backup</title>
        <script charset="utf-8" type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".restoreFile").hide();
            });
            function checkParameters(){
                var username = $.trim($("#username").val());
                var password = $.trim($("#password").val());
                var databasename = $.trim($("#databasename").val());
                if (username == ""){
                    alert("Plsease enter mysql username.");return false;
                }
                else if (password == ""){
                    alert("Plsease enter mysql password.");return false;
                }
                else if (databasename == ""){
                    alert("Plsease enter mysql database name.");return false;
                }
                else if($("#restore").is(':checked')){
                    var filename = $(".restoreFile").val();
                    if(filename == ""){
                        alert("Please choose a file.");return false;
                    }
                    else{
                        var valid_extensions = /(\.db|\.sql)$/;   
                        if (!valid_extensions.test(filename)){ 
                            alert('Invalid file format.');return false;
                        }                   
                    }
                }
                else{
                    return true;
                }
            }
            function showHide(id){
                if (id == "backup"){
                    $(".backupRadio").show();
                    $(".restoreFile").hide();
                }
                else{
                    $(".backupRadio").hide();
                    $(".restoreFile").show();
                }
            }
        </script>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return checkParameters();" enctype="multipart/form-data">
		<center><a href="index.php">BACK		</a></center><br/>
        <table border="0" bgcolor="#C0C0C0" align="center" width="40%">
            <tr>
                <td colspan="3" align="center"><b>Please enter the following parameters</b></td>
            </tr>
            <tr>
                <td>MySQL username*</td>
                <td>:</td>
                <td><input type="text" id="username" name="username" value="a2333010_root"/></td>
            </tr>
            <tr>
                <td>MySQL password*</td>
                <td>:</td>
                <td><input type="text" id="password" name="password" value="klangklang1"/></td>
            </tr>
            <tr>
                <td>MySQL database name*</td>
                <td>:</td>
                <td><input type="text" id="databasename" name="databasename" value="a2333010_cpstn"/></td>
            </tr>
            <tr>
                <td colspan="2">Backup <input type="radio" name="backupRestore" id="backup" value="backup" checked="true" onclick="showHide(this.id);" /></td>
                <td>
                    <div class="backupRadio">
                        <input type="radio" name="data" value="wd" checked="true" />With data 
                        <input type="radio" name="data" value="wod"/>With out data
                    </div>
                </td>
            </tr>
            <tr>
                <td>Restore <input type="radio" name="backupRestore" id="restore" value="restore" onclick="showHide(this.id);" /></td>
                <td></td>
                <td><input class="restoreFile" type="file" name="databasefile" /></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><input type="submit" value="Submit"/></td>
            </tr>
        </table>
        </form>
		
		<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'capstone504db';

function backup_tables($host,$user,$pass,$name,$tables = '*')
{

    $link = mysql_connect($host,$user,$pass);
    mysql_select_db($name,$link);
    mysql_query("SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
    $return='';
    //cycle through
    foreach($tables as $table)
    {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);

        $return.= 'DROP TABLE '.$table.';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++) 
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    //save file
    $handle = fopen('backup_temp/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
    fwrite($handle,$return);
    fclose($handle);
}

backup_tables($dbhost,$dbuser,$dbpass,$dbname);
	?>	
    </body>   
</html>