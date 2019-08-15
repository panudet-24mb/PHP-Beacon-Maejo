
<?php
   ini_set('display_errors', 1);
   error_reporting(~0);



     $serverName = "localhost";
     $userName = "root";
     $userPassword = "P@ssw0rd";
     $dbName = "beacon_maejo";

   $strmember_id = null;

   if(isset($_GET["member_id"]))
   {
	   $strmember_id = $_GET["member_id"];
   }


     $serverName = "localhost";
     $userName = "root";
     $userPassword = "P@ssw0rd";
     $dbName = "beacon_maejo";

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
   mysqli_set_charset($conn, "utf8");

   $sql = "SELECT * FROM member JOIN ble_base WHERE member_uid = ble_base_member_uid AND member_id = '".$strmember_id."' ";

   $query = mysqli_query($conn,$sql);

   $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

?>



 
<?php
mysqli_close($conn);
?>