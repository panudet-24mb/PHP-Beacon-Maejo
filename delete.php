
<?php
$connect = mysqli_connect("localhost", "root", "P@ssw0rd", "botnok");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM beacon WHERE beacon_id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>
