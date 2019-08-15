
<?php
$connect = mysqli_connect("localhost", "root", "P@ssw0rd", "botnok");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE beacon SET ".$_POST["column_name"]."='".$value."' WHERE beacon_id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>