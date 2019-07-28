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

	$sql = "UPDATE beacon SET
			beacon_hwid = '".$_POST["beacon_hwid"]."' ,
			beacon_msg = '".$_POST["beacon_msg"]."'
			WHERE beacon_id = '".$_POST["beacon_id"]."' ";
	$query = mysqli_query($conn,$sql);

	if($query) {
	 echo "Record update successfully";
	}

	mysqli_close($conn);
?>

<a href="botpost.php">go back</a>

</body>
</html>
