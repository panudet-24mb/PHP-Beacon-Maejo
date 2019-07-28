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

  $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
  mysqli_set_charset($conn, "utf8");

	$sql = "SELECT * FROM beacon";

	$query = mysqli_query($conn,$sql);
?>
<table width="650" border="1">
  <tr>
    <th width="91"> <div align="center">ID </div></th>
    <th width="98"> <div align="center">HW id </div></th>
    <th width="198"> <div align="center">Message </div></th>
	<th width="50"> <div align="center">Edit </div></th>
  </tr>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["beacon_id"];?></div></td>
    <td><?php echo $result["beacon_hwid"];?></td>
    <td><?php echo $result["beacon_msg"];?></td>
	<td align="center"><a href="edit.php?beacon_id=<?php echo $result["beacon_id"];?>">Edit</a></td>
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
