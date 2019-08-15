<html>
<head>
<title>Delete?</title>
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

	$website_id = $_GET["website_id"];
	$sql = "DELETE FROM websiteinfo
			WHERE websiteinfo_id = '".$website_id."' ";

	$query = mysqli_query($conn,$sql);

	if(mysqli_affected_rows($conn)) {
         echo "Record delete successfully";
         header("Location:https://www.pnall.co.th/apps/line/beacon_maejo/admin/edit_page_controller.php?Page=1");
	}

	mysqli_close($conn);
?>
</body>
</html>