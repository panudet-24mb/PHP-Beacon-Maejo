<html>
<head>
<title>PN ALL</title>
</head>
<body>
<?php

	ini_set('display_errors', 1);
    error_reporting(~0);

    $redirect = $_POST["websiteinfo_id"];

  $serverName = "localhost";
  $userName = "root";
  $userPassword = "P@ssw0rd";
  $dbName = "beacon_maejo";
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
    mysqli_set_charset($conn,"utf8");
	$sql = "UPDATE websiteinfo SET
			websiteinfo_header = '".$_POST["websiteinfo_header"]."' ,
			websiteinfo_main_content = '".$_POST["websiteinfo_main_content"]."',
			websiteinfo_sub_header = '".$_POST["websiteinfo_sub_header"]."' ,
			websiteinfo_sub_content = '".$_POST["websiteinfo_sub_content"]."',
			websiteinfo_below_header = '".$_POST["websiteinfo_below_header"]."' ,
			websiteinfo_below_content = '".$_POST["websiteinfo_below_content"]."'
			WHERE websiteinfo_id = '".$_POST["websiteinfo_id"]."' ";
	$query = mysqli_query($conn,$sql);

	if($query) {

     echo "Record update successfully";
	 header( "refresh:3;url=../admin/website_info_edit.php?website_id=".$redirect );
	 
	}

	mysqli_close($conn);
?>



</body>
</html>
