<?php
        session_start();

?>

<?php
        if ($_SESSION['admin_level'] == 1) {
            $level = "ble_base_0";
        }else if($_SESSION['admin_level'] == 2) {
            $level = "ble_base_1";
        }else if($_SESSION['admin_level'] == 3) {
            $level = "ble_base_2";
        }else if($_SESSION['admin_level'] == 4) {
            $level = "ble_base_3";
        }else if($_SESSION['admin_level'] == 5) {
            $level = "ble_base_4";
        }else if($_SESSION['admin_level'] == 6) {
            $level = "ble_base_5";
        }else if($_SESSION['admin_level'] == 7) {
            $level = "ble_base_6";
        }else if($_SESSION['admin_level'] == 8) {
            $level = "ble_base_7";
        }else{
            $level = "x";
        }

        $conn = new mysqli('localhost', 'root', 'P@ssw0rd', 'beacon_maejo');
        $uid= $_POST["uid"];
        $sql =      "UPDATE ble_base 
                    SET $level = '1'
                    WHERE ble_base_member_uid = '$uid' ";

        $query = mysqli_query($conn,$sql);
        $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

        if($conn->query($sql)===TRUE){

            echo "DATA updated  คุณ ".$uid."เรียบร้อย";
            
        }else {
            echo "can't find this ";
        }

            // ini_set('display_errors', 1);
            // error_reporting(~0);

            // $serverName = "localhost";
            // $userName = "root";
            // $userPassword = "P@ssw0rd";
            // $dbName = "beacon_maejo";

            // $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

            // $sql = "UPDATE ble_base 
            //         SET ble_base_0 = '1'
            // 		WHERE ble_base_member_uid = '$uid' ";

            // $update = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            // if($query) {
            //  echo "update successfully";
            // }else{
            //     echo "can't";
            // }

            // mysqli_close($conn);
