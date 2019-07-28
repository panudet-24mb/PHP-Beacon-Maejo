<html>
<head>
<title>Update????</title>
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
    mysqli_set_charset($conn,"utf8");
   $beacon_base = $_POST["beacon_has_websiteinfo_beacon_id"];

    // $beacon_has_websiteinfo_id = $_GET["beacon_has_websiteinfo_id"];
    
	// echo $beacon_has_websiteinfo_id;



	
        $sql = "UPDATE beacon SET
			    beacon_header= '".$_POST["beacon_header_active"]."' ,
                beacon_header_blank = '".$_POST["beacon_header_inactive"]."' 
		        WHERE beacon_id = '$beacon_base'";
	$query = mysqli_query($conn,$sql);


	if($query) {

     echo "Record update successfully";
    
     
     header( "refresh:1;url=../admin/edit_beacon_update.php?beacon_has_websiteinfo_beacon_id=".$beacon_base );

	}else{

        echo "no";

	}
	



	mysqli_close($conn);
?>


</body>
</html>