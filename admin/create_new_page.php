<html>

<head>
    <title>PHP & writefile</title>
</head>

<body>
    <?php
    $serverName = "localhost";
    $userName = "root";
    $userPassword = "P@ssw0rd";
    $dbName = "beacon_maejo";


    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    mysqli_set_charset($objCon, "utf8");

    $sql = "INSERT INTO `websiteinfo`(`websiteinfo_link`, `websiteinfo_header`, `websiteinfo_main_content`, `websiteinfo_sub_header`, `websiteinfo_sub_content`, `websiteinfo_below_header`, `websiteinfo_below_content`)
      VALUES ('websiteinfo_link','Header','Main Content','Sub Head','Sub Content','Third Header','Third Content')";
    // $query = mysqli_query($objCon, $sql);
    
    if(mysqli_query($objCon, $sql)){
        // Obtain last inserted id
        $last_id = mysqli_insert_id($objCon);
        echo "Records inserted successfully. Last inserted ID is: " . $last_id;
        header("Location:website_info_edit.php?website_id=".$last_id."");
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


    
    


    // $strSQL = "SELECT max(websiteinfo_id)  AS maxcount FROM websiteinfo";
    // $objQuery = mysqli_query($objCon, $strSQL);
    // $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);





    // $strFileName = "../info/base_" . $objResult["maxcount"] . ".php";
    // $objFopen = fopen($strFileName, 'w');

   

    // fwrite($objFopen, $strText1);

    // if ($objFopen) {
    //     echo "File writed.";
    //     echo $objResult["maxcount"];
    // } else {
    //     echo "File can not write";
    // }




    fclose($objFopen);
    mysqli_close($objCon);


    


    ?>




    
</body>

</html>