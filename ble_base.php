<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

    $serverName = "localhost";
    $userName = "root";
    $userPassword = "P@ssw0rd";
    $dbName = "beacon_maejo";
    

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$sql = "SELECT * FROM ble_base";

	$query = mysqli_query($conn,$sql);

?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">ID </div></th>
    <th width="98"> <div align="center">member </div></th>
    <th width="198"> <div align="center">base </div></th>
    
  </tr>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["ble_base_id"];?></div></td>
    <td><?php echo $result["ble_base_member_uid"];?></td>
    <td><?php echo $result["ble_base_0"];?></td>
   
  </tr>
<?php
}
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
</html>