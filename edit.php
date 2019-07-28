<html>
<head>
<title>PN ALL</title>
</head>
<body>
<?php
   ini_set('display_errors', 1);
   error_reporting(~0);



     $serverName = "localhost";
     $userName = "root";
     $userPassword = "P@ssw0rd";
     $dbName = "beacon_maejo";

   $strbeacon_id = null;

   if(isset($_GET["beacon_id"]))
   {
	   $strbeacon_id = $_GET["beacon_id"];
   }


     $serverName = "localhost";
     $userName = "root";
     $userPassword = "P@ssw0rd";
     $dbName = "beacon_maejo";

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
   mysqli_set_charset($conn, "utf8");

   $sql = "SELECT * FROM beacon WHERE beacon_id = '".$strbeacon_id."' ";

   $query = mysqli_query($conn,$sql);

   $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

?>
<form action="save_postbot.php" name="frmAdd" method="post">
<table width="284" border="1">
  <tr>
    <th width="120">ID</th>
    <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["beacon_id"];?>"><?php echo $result["beacon_id"];?></td>
    </tr>
  <tr>
    <th width="120">hw</th>
    <td><input type="hidden" name="beacon_hwid" size="20" value="<?php echo $result["beacon_hwid"];?>"><?php echo $result["beacon_hwid"];?></td>
    </tr>
  <tr>
    <th width="120">message</th>
    <td><input type="text" name="beacon_msg" size="20" value="<?php echo $result["beacon_msg"];?>"></td>
    </tr>

  </table>
  <input type="submit" name="submit" value="submit">
</form>
<?php
mysqli_close($conn);
?>
</body>
</html>
