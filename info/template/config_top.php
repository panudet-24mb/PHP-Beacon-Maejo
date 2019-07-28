<?php



$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";

$str_page = null;

if(isset($_GET["page"]))
{
    $str_page = $_GET["page"];
}

$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
mysqli_set_charset($objCon, "utf8");

$strSQL = "SELECT * FROM websiteinfo WHERE websiteinfo_id = $str_page";
$objQuery = mysqli_query($objCon, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);


?>