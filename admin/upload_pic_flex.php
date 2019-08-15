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
    
    $path = "https://www.pnall.co.th/apps/line/beacon_maejo/admin/images_upload_flex/";

    if($_POST){
        if(isset($_FILES['upload'])){
            $name_file =  $_FILES['upload']['name'];
            $tmp_name =  $_FILES['upload']['tmp_name'];
            $locate_img ="images_upload_flex/";
            move_uploaded_file($tmp_name,$locate_img.$name_file);
            
            $sql = "UPDATE beacon SET
            beacon_img_active= '$path$name_file' 
            WHERE beacon_id = '$beacon_base'";
            $query = mysqli_query($conn,$sql);
    
        }
    }


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