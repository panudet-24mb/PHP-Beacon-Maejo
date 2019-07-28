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


$beacon_has_websiteinfo_beacon_id = null;

if (isset($_GET["beacon_has_websiteinfo_beacon_id"])) {
  $beacon_has_websiteinfo_beacon_id = $_GET["beacon_has_websiteinfo_beacon_id"];
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    beacon_maejo
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>


<?php include 'mod_menu.php' ?>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
    </div>


    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form">
        <div class="input-group no-border">

          <div class="ripple-container"></div>
          </button>
        </div>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#pablo">


          </a>
        </li>
        <li class="nav-item dropdown">

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

          </div>
        </li>
        <li class="nav-item dropdown">

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">ตั้งค่าอุปกรณ์ Beacon </h4>
        <p class="card-category">Beacon setting</p>
      </div>
      <div class="card-body">
        <div id="typography">
          <div class="card-title">
            <h2>กรุณาเลือกหัวข้อที่คุณอยากให้แสดงในฐานที่ <?php echo $beacon_has_websiteinfo_beacon_id; ?></h2>
          </div>
          <input type="hidden" id="custId" name="custId" value="3487">
          <div class="form-group">
            <form action="edit_beacon_update_websiteinfo.php" method="post">
              <?php
              // start of dbcon
              $servername = "localhost";
              $username = "root";
              $password = "P@ssw0rd";
              $dbname = "beacon_maejo";


              $conn = new mysqli($servername, $username, $password, $dbname);
              //end of dbcon

              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }



              //   $sql2 = "SELECT websiteinfo.websiteinfo_header FROM beacon_has_websiteinfo left join websiteinfo on beacon_has_websiteinfo.beacon_has_websiteinfo_websiteinfo_id = websiteinfo.websiteinfo_id
              //           WHERE beacon_has_websiteinfo_beacon_id = $beacon_has_websiteinfo_beacon_id;
              //           ";

              // $result_index = $conn->query($sql2);

              $sql_direct = " SELECT websiteinfo.websiteinfo_header FROM beacon_has_websiteinfo left join websiteinfo on beacon_has_websiteinfo.beacon_has_websiteinfo_websiteinfo_id = websiteinfo.websiteinfo_id
                  WHERE beacon_has_websiteinfo_beacon_id = $beacon_has_websiteinfo_beacon_id";
              $result3 = $conn->query($sql_direct);
              $result4 = mysqli_fetch_array($result3, MYSQLI_ASSOC);

              $sql = " SELECT * FROM websiteinfo";
              echo "<script>
                            function goToPage(mySelect){
                                frames['iframe2'].location.src = $(mySelect).val();
                            }
                        </script>";

              $result = $conn->query($sql);
              echo "  <select class='form-control' id='exampleFormControlSelect1' name='beacon_has_websiteinfo_websiteinfo_id' onchange='getSrc(this.value)' target='iframe2'>";
              echo "<option value=' ' selected disabled hidden> " . $result4["websiteinfo_header"] . " </option>";

              if ($result->num_rows > 0) {




                // output data of each row
                while ($row = $result->fetch_assoc()) {

                  echo "<option value='" . $row['websiteinfo_id'] . "'>" . $row['websiteinfo_header'] . "</option>";
                }
                echo "</select>";
              }
              $conn->close();
              ?>
              <input type="hidden" id="beacon_has_websiteinfo_beacon_id" name="beacon_has_websiteinfo_beacon_id" value=<?php echo $beacon_has_websiteinfo_beacon_id; ?>>

              
              <input class="btn btn-success" type="submit" value="UPDATE">
          </div>
          </form>

          <iframe runat="server" id="iframe2" src="https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page=" height="280" width="100%" frameborder="1" allowTransparency="true">
            <p>Your browser does not support iframes.</p>
          </iframe>

         


        </div>

     
      
      </div>
    </div>
  </div>

        <?php 

                        

                    $serverName = "localhost";
                    $userName = "root";
                    $userPassword = "P@ssw0rd";
                    $dbName = "beacon_maejo";

                  $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
                  mysqli_set_charset($conn, "utf8");
                  $beacon = "SELECT * FROM beacon WHERE beacon_id = $beacon_has_websiteinfo_beacon_id ";
                  $query_beacon = mysqli_query($conn,$beacon);
                  $show_beacon = mysqli_fetch_array($query_beacon,MYSQLI_ASSOC);
              
               
              
               
                
               

        ?>
        
  <style>

h5{
  text-align: center;
}
h3 {
  text-align: center;
}



</style>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">ตั้งค่าอุปกรณ์ Flex Message </h4>
        <p class="card-category">Flex Message setting</p>
      </div>

          

  <div class="row justify-content-center ">

  <div class="col-sm-3">
  <div class="card" >

  

            <h3> Active </h3>
            
  <img class="card-img-top" src="<?php echo $show_beacon["beacon_img_active"]; ?>"  class="img-responsive center-block"  alt="Card image cap">

      <form class="imgForm" action="upload_pic_flex.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upload" />
        <input type="hidden" id="beacon_has_websiteinfo_beacon_id" name="beacon_has_websiteinfo_beacon_id" value=<?php echo $beacon_has_websiteinfo_beacon_id; ?>>
        <input type="submit"  name="save"  value="upload" />
    </form>

    <form action="edit_beacon_update_flex.php" method="post" enctype="multipart/form-data" >


  <div class="card-body">
    <h5 class="card-title"> Header:   <input type="text" name="beacon_header_active" value=" <?php echo $show_beacon["beacon_header"]; ?>"><br>       </h5>
    <h5 class="card-title"> คุณได้รับคะแนนทั้งหมด {{val}}แต้ม<br>       </h5>
  </div>
  <div class="card-body">
  <h5 class="card-title">     รายละเอียดฐานที่ <?php echo $beacon_has_websiteinfo_beacon_id; ?> </h5>
    <h5 class="card-title">   เว็บไซต์เพื่มเติม  </h5>
  </div>
  
 

</div>


  </div>
  <div class="col-sm-3">
  <div class="card" >
  <h3> InActive </h3>
  <img class="card-img-top" src="../img/noitem.jpg"  class="img-responsive center-block"  alt="Card image cap">

  <div class="card-body">
    <h5 class="card-title"> Header:   <input type="text" name="beacon_header_inactive" value=" <?php echo $show_beacon["beacon_header_blank"]; ?>"><br>       </h5>
    <h5 class="card-title"> คุณได้รับคะแนนทั้งหมด {{val}}แต้ม<br>       </h5>
  </div>
  <div class="card-body">
  <h5 class="card-title">     รายละเอียดฐานที่ <?php echo $beacon_has_websiteinfo_beacon_id; ?> </h5>
    <h5 class="card-title">   เว็บไซต์เพื่มเติม  </h5>
  </div>
  
</div>
  </div>
</div>
<input type="hidden" id="beacon_has_websiteinfo_beacon_id" name="beacon_has_websiteinfo_beacon_id" value=<?php echo $beacon_has_websiteinfo_beacon_id; ?>>
              
<button class="btn btn-success" type="submit">Update</button>

</form>
</div>

</div>  </div>  </div>

<!-- End Navbar -->



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
  $(document).ready(function() {
    $().ready(function() {
      $sidebar = $('.sidebar');

      $sidebar_img_container = $sidebar.find('.sidebar-background');

      $full_page = $('.full-page');

      $sidebar_responsive = $('body > .navbar-collapse');

      window_width = $(window).width();

      fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

      if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
        if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
          $('.fixed-plugin .dropdown').addClass('open');
        }

      }

      $('.fixed-plugin a').click(function(event) {
        // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
        if ($(this).hasClass('switch-trigger')) {
          if (event.stopPropagation) {
            event.stopPropagation();
          } else if (window.event) {
            window.event.cancelBubble = true;
          }
        }
      });

      $('.fixed-plugin .active-color span').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data-color', new_color);
        }

        if ($full_page.length != 0) {
          $full_page.attr('filter-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.attr('data-color', new_color);
        }
      });

      $('.fixed-plugin .background-color .badge').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('background-color');

        if ($sidebar.length != 0) {
          $sidebar.attr('data-background-color', new_color);
        }
      });

      $('.fixed-plugin .img-holder').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
          $sidebar_img_container.fadeOut('fast', function() {
            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $sidebar_img_container.fadeIn('fast');
          });
        }

        if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $full_page_background.fadeOut('fast', function() {
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
            $full_page_background.fadeIn('fast');
          });
        }

        if ($('.switch-sidebar-image input:checked').length == 0) {
          var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
          var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
        }

        if ($sidebar_responsive.length != 0) {
          $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
        }
      });

      $('.switch-sidebar-image input').change(function() {
        $full_page_background = $('.full-page-background');

        $input = $(this);

        if ($input.is(':checked')) {
          if ($sidebar_img_container.length != 0) {
            $sidebar_img_container.fadeIn('fast');
            $sidebar.attr('data-image', '#');
          }

          if ($full_page_background.length != 0) {
            $full_page_background.fadeIn('fast');
            $full_page.attr('data-image', '#');
          }

          background_image = true;
        } else {
          if ($sidebar_img_container.length != 0) {
            $sidebar.removeAttr('data-image');
            $sidebar_img_container.fadeOut('fast');
          }

          if ($full_page_background.length != 0) {
            $full_page.removeAttr('data-image', '#');
            $full_page_background.fadeOut('fast');
          }

          background_image = false;
        }
      });

      $('.switch-sidebar-mini input').change(function() {
        $body = $('body');

        $input = $(this);

        if (md.misc.sidebar_mini_active == true) {
          $('body').removeClass('sidebar-mini');
          md.misc.sidebar_mini_active = false;

          $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

        } else {

          $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

          setTimeout(function() {
            $('body').addClass('sidebar-mini');

            md.misc.sidebar_mini_active = true;
          }, 300);
        }

        // we simulate the window Resize so the charts will get updated in realtime.
        var simulateWindowResize = setInterval(function() {
          window.dispatchEvent(new Event('resize'));
        }, 180);

        // we stop the simulation of Window Resize after the animations are completed
        setTimeout(function() {
          clearInterval(simulateWindowResize);
        }, 1000);

      });
    });
  });
</script>
</body>

</html>