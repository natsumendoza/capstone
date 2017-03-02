<?php

//use this code at your own risk, not responsible for any problems with you DB or Dropbox if you set things up wrong or there is an unforeseen code conflict in this script!

# Include the Dropbox SDK libraries
require_once __DIR__."/dropbox-sdk/lib/Dropbox/autoload.php";
use \Dropbox as dbx;
//your access token from the Dropbox App Panel
$accessToken = 'aIYaeuUoS9AAAAAAAAAACF_fddo1GZBl9bXrLdI8CH_FdW_-hVwdhO4tI1yslCv4';

//run the MySQL dump and zip;

// location of your temp directory
$tmpDir = "backup_temp";
// username for MySQL
$user = "root";
// password for MySQL
$password = "";
// database name to backup
$dbName = "capstone504db";
// hostname or IP where database resides
$dbHost = "localhost";
// the zip file will have this prefix
$prefix = "sql_db_";

// Create the database backup file
$sqlFile = $tmpDir.$prefix.date('Y_m_d_h:i:s').".sql";
$backupFilename = $prefix.date('Y_m_d_h:i:s').".tgz";
$backupFile = $tmpDir.$backupFilename;

$createBackup = "mysqldump -h ".$dbHost." -u ".$user." --password='".$password."' ".$dbName." --> ".$sqlFile;
//echo $createBackup;
$createZip = "tar cvzf $backupFile $sqlFile";
//echo $createZip;
exec($createBackup);
exec($createZip);

//now run the DBox app info and set the client; we are naming the app folder SQL_Backup but CHANGE THAT TO YOUR ACTUAL APP FOLDER NAME;

$appInfo = dbx\AppInfo::loadFromJsonFile(__DIR__."/config.json");
$dbxClient = new dbx\Client($accessToken, "SQL_Backup");


//now the main handling of the zipped file upload;

//this message will send in a system e-mail from your cron job (assuming you set up cron to email you);
echo("Uploading $backupFilename to Dropbox\n");

//this is the actual Dropbox upload method;
$f = fopen($backupFile, "rb");
$result = $dbxClient->uploadFile('/SQL_Backup/'.$backupFilename, dbx\WriteMode::force(), $f);
fclose($f);

// Delete the temporary files
unlink($sqlFile);
unlink($backupFile);

?>