<?php
session_start();
if ($_SESSION['admin_id'] == "") {
  echo "Please Login!";
  exit();
}


$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";


$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
mysqli_set_charset($objCon, "utf8");

$strSQL = "SELECT * FROM admin WHERE admin_id = '" . $_SESSION['admin_id'] . "' ";
$objQuery = mysqli_query($objCon, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);


?>

<!doctype html>
<html lang="en">

<head>
  <title>Baecon! Website</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>
<?php include 'mod_menu.php' ?>

<body>


  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo"> สวัสดีคะ <?php echo $objResult["admin_name"]; ?></a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="content">
    <div class="container-fluid">
      <!-- your content here -->



      <?php

      $strSQL = "SELECT COUNT(ble_base_id) number_enter FROM ble_base  WHERE ble_base_0 = '1'";

      $objQuery = mysqli_query($objCon, $strSQL);
      $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);



      $str2 = "SELECT COUNT(ble_base_id) AS number_all FROM ble_base";

      $objQuery2 = mysqli_query($objCon, $str2);
      $objResult2 = mysqli_fetch_array($objQuery2, MYSQLI_ASSOC);

      ?>


      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                  </div>
                  <p class="card-category">จำนวนสมาชิกในระบบทั้งหมด  </p>


                  <h3 class="card-title"><?php echo $objResult2["number_all"] ?>
                    <small>คน</small>
                  </h3>
                </div>


                <div class="card-footer">
                  
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">ฐานที่มีผู้เข้าชมมากที่สุด</p>
                  <h3 class="card-title">0/0 คน</h3>
                </div>
                <div class="card-footer">
                 
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">แลกของรางวัลไปแล้วทั้งหมด</p>
                  <h3 class="card-title">75</h3>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-twitter"></i>
                  </div>
                  <p class="card-category">มีผู้ติดตามบนไลน์ทั้งหมด</p>
                  <h3 class="card-title">+245</h3>
                </div>
                <div class="card-footer">
                  
                </div>
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Log beacon</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">bug_report</i> Log Infomation
                            <div class="ripple-container"></div>
                          </a>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">

                  <div class="table-responsive">


                    <div class="table-responsive" id="profile">
                      <table class="table">
                        <form name="form1" method="get" action="">

                             <div class="form-group row">
                            <label for="keyword" class="col-sm-4 col-form-label text-right">
                              <br>

                            </label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="keyword" id="keyword" placeholder="ค้นหาชื่อผู้ใช้งาน" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : "" ?>">
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <select class="custom-select" name="myselect" id="myselect">
                              <option value="">เลื่อกเงื่่อนไข</option>
                              <option value="beacon" <?= (isset($_GET['myselect']) && $_GET['myselect'] == "beacon") ? " selected" : "" ?>>ประเภท Beacon</option>
                              <option value="message" <?= (isset($_GET['myselect']) && $_GET['myselect'] == "message") ? " selected" : "" ?>>ประเภท ข้อความ</option>
                            </select>
                          </div>


                    </div>   


                    <div class="form-oup row">
                      <div class="col-md-12 col-md-offset-4">

                        <button type="submit" class="btn btn-primary float-right" name="btn" id="btn">ค้นหา</button>
                        &nbsp;&nbsp;
                        <a href="admin_page.php" class="btn btn-danger float-right">ล้างค่า</a>
                      </div>
                    </div>

                    </form>

                    <tbody>
                      <tr>
                        <td>
                          #
                        </td>
                        <td>
                          Event Type
                        </td>
                        <td>
                          Name
                        </td>
                        <td>
                          Beacon Type
                        </td>
                        <td>
                          Beacon Hwid
                        </td>
                        <td>
                          Message
                        </td>
                        <td>
                          TimeStamp
                        </td>







                        <?php include 'demo.php' ?>
                        <?php


                        if ($result && $result->num_rows > 0) {  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
                          while ($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                            $num++;
                            ?>
                          <tr>
                            <!-- <th class="text-center" scope="row"><?= ($step_num * $e_page) + $num ?></th> -->
                            <td><?php echo $row["log_id"]; ?></td>
                            <td><?php echo $row["member_name"]; ?></td>
                            <td><?php echo $row["log_event"]; ?></td>
                            <td><?php echo $row["log_beacon_type"]; ?></td>
                            <td><?php if ($row["log_beacon_hwid"] == "01265d5c2a") {
                                  echo "จุดที่ 1";
                                } else if ($row["log_beacon_hwid"] == "01265fcfaf") {
                                  echo "จุดที่ 2";
                                } else if ($row["log_beacon_hwid"] == "012d56174b") {
                                  echo "จุดที่ 3";
                                } else if ($row["log_beacon_hwid"] == "012db75b67") {
                                  echo "จุดที่ 4";
                                } else if ($row["log_beacon_hwid"] == "012db84e44") {
                                  echo "จุดที่ 5";
                                } else if ($row["log_beacon_hwid"] == "012db8ebda") {
                                  echo "จุดที่ 6";
                                } else if ($row["log_beacon_hwid"] == "012dbae387") {
                                  echo "จุดที่ 7";
                                } else if ($row["log_beacon_hwid"] == "012dbbc5d6") {
                                  echo "จุดที่ 8";
                                }
                                ?>

                            </td>
                            <td><?php echo $row["log_text"]; ?></td>

                            <td class="moment-format"><?php
                                                      $timestamp = $row["log_timestamp"];


                                                      echo date("Y-m-d H:i:s", ($timestamp / 1000) + 25200); ?></td>


                          </tr>





                        <?php
                        }
                      }
                      ?>







                    </tbody>
                    <?php page_navi($total, (isset($_GET['page'])) ? $_GET['page'] : 1, $e_page, $_GET); ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>





            <br>




            <div class="row">
              <div class="col-lg-6 col-md-12">
                <div class="card">
                  <div class="card-header card-header-tabs card-header-primary">
                    <div class="nav-tabs-navigation">
                      <div class="nav-tabs-wrapper">
                        <span class="nav-tabs-title">ข้อเสนอแนะที่เข้ามาใหม่:</span>
                        <ul class="nav nav-tabs" data-tabs="tabs">
                          <li class="nav-item">
                            <a class="nav-link active" href="#profile" data-toggle="tab">
                              <i class="material-icons">bug_report</i> Comment
                              <div class="ripple-container"></div>
                            </a>
                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="profile">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td>

                              </td>







                              <?php include 'comment.php' ?>
                              <?php

                              while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                ?>
                              <tr>
                                <td>
                                  <div align="center"><?php echo $result["comment_id"]; ?></div>
                                </td>
                                <td><?php echo $result["comment_message"]; ?></td>
                                <td><?php echo $result["member_name"]; ?></td>

                              </tr>



                            <?php
                            }
                            ?>


                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>





              <div class="col-lg-6 col-md-12">
                <div class="card">
                  <div class="card-header card-header-warning">
                    <h4 class="card-title">Beacon device </h4>
                    <p class="card-category">อุปกรณ์ hardware beacon ในแต่ละจุด</p>
                  </div>
                  <div class="card-body table-responsive">
                    <table class="table table-hover">
                      <thead class="text-warning">
                        <th>#</th>
                        <th>HardwareID</th>
                        <th>msg</th>
                        <th>update</th>
                        <!-- <th>edit</th> -->
                      </thead>
                      <tbody>




                        <?php include 'hwbeaconpagination.php' ?>
                        <?php

                        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                          ?>
                          <tr>
                            <td>
                              <div align="center"><?php echo $result["beacon_id"]; ?></div>
                            </td>
                            <td><?php echo $result["beacon_hwid"]; ?></td>
                            <td><?php echo $result["beacon_msg"]; ?></td>
                            <td><?php echo $result["beacon_updatedate"]; ?></td>
                            <!-- <td align="center"><a href="../edit.php?beacon_id=<?php echo $result["beacon_id"]; ?>">Edit</a></td> -->

                          </tr>



                        <?php
                        }
                        ?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</body>


<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>
<script>
  var fields = document.querySelectorAll('td.moment-format');
  fields.forEach(function(field, index) {

    field.textContent = moment(field.textContent).format('MMMM Do YYYY, h:mm:ss a');

  })
</script>

</html>