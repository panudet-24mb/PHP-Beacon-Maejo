<?php


$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";

$conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
mysqli_set_charset($conn, "utf8");

require_once("pagination_function.php");
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css">

</head>

<body>

   
    <div class="container">


        <!-- <div class="table-responsive-sm">
<table class="table table-bordered table-striped table-hover table-sm">
  <thead >
    <tr class="table-primary">
      <th class="text-center" scope="col" width="30">#</th>
      <th class="text-left" scope="col">ชื่อจังหวัด</th>
    </tr>
  </thead>
  <tbody> -->
        <?php
        $num = 0;
        $sql = "SELECT * FROM log JOIN member where log_userid = member_uid ";
        //////////////////// MORE QUERY 
        // เงื่อนไขสำหรับ radio
        // if(isset($_GET['myradio']) && $_GET['myradio']!=""){
        //     // ต่อคำสั่ง sql 
        //     $sql.=" AND province_name LIKE '%".trim($_GET['myradio'])."%' ";    
        // }

        // เงื่อนไขสำหรับ input text
        if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
            // ต่อคำสั่ง sql 
            $sql .= " AND member_name LIKE '%" . trim($_GET['keyword']) . "%' ";
        }

        // เงื่อนไขสำหรับ select
        if(isset($_GET['myselect']) && $_GET['myselect']!=""){
            // ต่อคำสั่ง sql 
            $sql.=" AND log_event LIKE '".trim($_GET['myselect'])."%' ";    
        }else{
            
        }
        

        // // เงื่อนไขสำหรับ checkbox
        // if((isset($_GET['mycheckbox1']) && $_GET['mycheckbox1']!="") 
        // || (isset($_GET['mycheckbox2']) && $_GET['mycheckbox2']!="")){
        //     // ต่อคำสั่ง sql 
        //     if($_GET['mycheckbox1']!="" && $_GET['mycheckbox2']!=""){
        //          $sql.=" 
        //          AND (province_name LIKE '%".trim($_GET['mycheckbox1'])."'
        //          OR province_name LIKE '%".trim($_GET['mycheckbox2'])."' )
        //          "; 
        //     }elseif($_GET['mycheckbox1']!=""){
        //          $sql.=" AND province_name LIKE '%".trim($_GET['mycheckbox1'])."' ";                    
        //     }elseif($_GET['mycheckbox2']!=""){
        //          $sql.=" AND province_name LIKE '%".trim($_GET['mycheckbox2'])."' ";                    
        //     }else{

        //     }
        // }
        //////////////////// MORE QUERY 
        $result = $conn->query($sql);
        $total = $result->num_rows;

        $e_page = 10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
        $step_num = 0;
        if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == 1)) {
            $_GET['page'] = 1;
            $step_num = 0;
            $s_page = 0;
        } else {
            $s_page = $_GET['page'] - 1;
            $step_num = $_GET['page'] - 1;
            $s_page = $s_page * $e_page;
        }
        $sql .= " ORDER BY log_id DESC LIMIT " . $s_page . ",$e_page";
        $result = $conn->query($sql);

        ?>
        <!-- </tbody>
</table> -->

        <!-- <?php
                page_navi($total, (isset($_GET['page'])) ? $_GET['page'] : 1, $e_page, $_GET);
                ?> -->
        <!-- </div> -->

        <!-- </div> -->

        <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
        <script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {

            });
        </script>
</body>

</html>