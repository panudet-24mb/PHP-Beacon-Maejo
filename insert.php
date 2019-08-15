
<?php
$connect = mysqli_connect("localhost", "root", "P@ssw0rd", "botnok");
if(isset($_POST["beacon_id"], $_POST["beacon_userid"], $_POST["beacon_hardware"], $_POST["beacon_datetime"]))
{
 $beacon_id = mysqli_real_escape_string($connect, $_POST["beacon_id"]);
 $beacon_userid = mysqli_real_escape_string($connect, $_POST["beacon_userid"]);
 $beacon_hardware = mysqli_real_escape_string($connect, $_POST["beacon_hardware"]);
 $beacon_datetime = mysqli_real_escape_string($connect, $_POST["beacon_datetime"]);
 $query = "INSERT INTO beacon(beacon_id,beacon_userid,beacon_hardware,beacon_datetime) VALUES('$beacon_id', '$beacon_userid','$beacon_hardware','$beacon_datetime')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
