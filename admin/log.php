<?php
   ini_set('display_errors', 1);
   error_reporting(~0);

   $serverName = "localhost";
   $userName = "root";
   $userPassword = "P@ssw0rd";
   $dbName = "beacon_maejo";

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
   mysqli_set_charset($conn, "utf8");

    $sql = "SELECT * FROM log JOIN member where log_userid = member_uid ";
    mysqli_set_charset($conn,"utf8");
	$query = mysqli_query($conn,$sql);

	$num_rows = mysqli_num_rows($query);

	$per_page = 10;   // Per Page
	$pageX  = 1;
	
	if(isset($_GET["PageX"]))
	{
		$pageX = $_GET["PageX"];
	}

	$prev_page = $pageX-1;
	$next_page = $pageX+1;

	$row_start = (($per_page*$pageX)-$per_page);
	if($num_rows<=$per_page)
	{
		$num_pages =1;
	}
	else if(($num_rows % $per_page)==0)
	{
		$num_pages =($num_rows/$per_page) ;
	}
	else
	{
		$num_pages =($num_rows/$per_page)+1;
		$num_pages = (int)$num_pages;
	}
	$row_end = $per_page * $pageX;
	if($row_end > $num_rows)
	{
		$row_end = $num_rows;
	}


	$sql .= " ORDER BY log_id DESC LIMIT $row_start ,$row_end ";
	$query = mysqli_query($conn,$sql);

?>


Total <?php echo $num_rows;?> Record : <?php echo $num_pages;?> Page :
<?php
if($prev_page)
{
	echo " <a href='$_SERVER[SCRIPT_NAME]?PageX=$prev_page'><< Back</a> ";
}

for($i=1; $i<=$num_pages; $i++){
	if($i != $pageX)
	{
		echo "[ <a href='$_SERVER[SCRIPT_NAME]?PageX=$i'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
if($pageX!=$num_pages)
{
	echo " <a href ='$_SERVER[SCRIPT_NAME]?PageX=$next_page'>Next>></a> ";
}
$conn = null;
?>