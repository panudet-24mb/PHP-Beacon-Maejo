<?php
	session_start();
    $serverName = "localhost";
    $userName = "root";
    $userPassword = "P@ssw0rd";
    $dbName = "beacon_maejo";

	$objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$strSQL = "SELECT * FROM admin WHERE admin_username = '".mysqli_real_escape_string($objCon,$_POST['txtUsername'])."' 
	and admin_password = '".mysqli_real_escape_string($objCon,$_POST['txtPassword'])."'";
	$objQuery = mysqli_query($objCon,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
            $_SESSION["admin_id"] = $objResult["admin_id"];
            $_SESSION["admin_level"] = $objResult["admin_level"];
            $_SESSION["admin_name"] = $objResult["admin_name"];
		
		

			session_write_close();
			
			if($objResult["admin_level"] == "1")
			{
				header("location:admin_page.php");
			}
			else if($objResult["admin_level"] == "2")
			{
				header("location:admin_page.php");
			}
			else if($objResult["admin_level"] == "3")
			{
				header("location:admin_page.php");
			}
			else 	if($objResult["admin_level"] == "4")
			{
				header("location:admin_page.php");
			}
			else 	if($objResult["admin_level"] == "5")
			{
				header("location:admin_page.php");
			}
			else 	if($objResult["admin_level"] == "6")
			{
				header("location:admin_page.php");
			}
			else 	if($objResult["admin_level"] == "7")
			{
				header("location:admin_page.php");
			}
			else 	if($objResult["admin_level"] == "8")
			{
				header("location:admin_page.php");
			}
			else
			{
				header("location:404.php");
			}
	}
	mysqli_close($objCon);
?>