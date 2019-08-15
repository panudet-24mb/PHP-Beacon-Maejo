<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Material Dashboard by Creative Tim
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
            <a class="navbar-brand" href="#pablo">User Profile</a>
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
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#pablo">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            Stats
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">
                            Some Actions
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Mike John responded to your email</a>
                        <a class="dropdown-item" href="#">You have 5 new tasks</a>
                        <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                        <a class="dropdown-item" href="#">Another Notification</a>
                        <a class="dropdown-item" href="#">Another One</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            Account
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- End Navbar -->
<?php include 'checkinfo_module.php' ?>
<div class="content">
    <div class="container-fluid">

                        

   <div class="row">
  <div class="col-sm-4">
    <div class="card text-left">
      <div class="card-body ">
      <img src="<?php  echo $result["member_pic"]; ?>" class="rounded mx-auto d-block"  style="width: 18rem;">
      <br>
        <h5 class="card-title">DisplayName:<?php  echo $result["member_displayname"]; ?></h5>
        <h5 class="card-title">UID:<?php  echo $result["member_uid"]; ?></h5>
        <h5 class="card-title">ชื่อจริง: <?php  echo $result["member_name"]; ?></h5>
        <h5 class="card-title">เพศ: <?php  echo $result["member_gender"]; ?></h5>
        <h5 class="card-title">อายุ: <?php  echo $result["member_age"]; ?></h5>
        <p class="card-text">สมัครสมาชิกเข้ามาเมื่อ <?php  echo $result["member_date"]; ?></p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
       
        <div class="container">

               
  <h1>กิจกรรมฐาน :  <?php echo ($result["ble_base_0"]*12.5)+($result["ble_base_1"]*12.5)+($result["ble_base_2"]*12.5) +($result["ble_base_3"]*12.5)  +($result["ble_base_4"]*12.5)  +($result["ble_base_5"]*12.5)  +($result["ble_base_6"]*12.5)  +($result["ble_base_7"]*12.5);?> %</h1>
  <div class="progress">
    <div class="progress-bar progress-bar-striped" style="width: <?php echo ($result["ble_base_0"]*12.5)+($result["ble_base_1"]*12.5)+($result["ble_base_2"]*12.5) +($result["ble_base_3"]*12.5)  +($result["ble_base_4"]*12.5)  +($result["ble_base_5"]*12.5)  +($result["ble_base_6"]*12.5)  +($result["ble_base_7"]*12.5);?>%"></div>
  </div>
  <h1>แลกของรางวัล :ยังไม่เคยแลกของรางวัล </h1>
  
      </div>
    </div>
  </div>
</div>
                    
                    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">User Database </h4>
                        <p class="card-category"> Info </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th width="120">UID</th>
                                    <th width="120">NAME</th>
                                    <th width="120">ฐานที่ 1</th>
                                    <th width="120">ฐานที่ 2</th>
                                    <th width="120">ฐานที่ 3</th>
                                    <th width="120">ฐานที่ 4</th>
                                    <th width="120">ฐานที่ 5</th>
                                    <th width="120">ฐานที่ 6</th>
                                    <th width="120">ฐานที่ 7</th>
                                    <th width="120">ฐานที่ 8</th>
                                </thead>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["member_id"]; ?>"><?php echo $result["member_uid"]; ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["member_name"]; ?>"><?php echo $result["member_name"]; ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_0"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_1"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_2"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_3"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_4"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_5"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_6"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                <td width="238"><input type="hidden" name="beacon_id" value="<?php echo $result["ble_base_0"]; ?>"><?php if ( $result["ble_base_7"]=='0'){echo "not complete";}else{echo"passed";} ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">PUSH Message </h4>
        <p class="card-category">Line BOT </p>
      </div>

          

 
<div class="col-sm-12">
  <div class="card" >

  <h3> USER CHAT HISTORY </h3>
  <div style="width:100%;height:600px;line-height:3em;overflow:auto;padding:5px;">
 <?php 

$uid = $result["member_uid"];

$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";
  $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
  mysqli_set_charset($conn,"utf8");

  $sqlx = "SELECT * FROM member JOIN log ON log.log_userid = member.member_uid WHERE member_uid = '$uid' AND log_event ='message' ";
   

  $queryx = mysqli_query($conn,$sqlx);
  

  while($resultx=mysqli_fetch_array($queryx,MYSQLI_ASSOC)){

    ?><td><?php echo $resultx["member_name"]; ?>  :    <?php echo $resultx["log_text"];?>  เวลา - 
     <?php  
                $timestamp = $resultx["log_timestamp"];
                echo date("Y-m-d H:i:s", ($timestamp / 1000) + 25200);
                ?> 
      </td>
     <br>
    <?php
  }
  
  ?>


</div>

  
</div>

</div>  

<div class="col-md-12">
  <div class="card" >

  

            <h3> ส่งข้อความถึง <?php echo $result["member_name"]; ?> </h3>
            


    

    <form action="LinePushMessage.php" method="post" enctype="multipart/form-data" >

    <br>
 
<p>Message :</p>
  
  <textarea class="form-control" rows="5" id="message" name="message" required></textarea>


<input type="hidden" id="member_name" name="member_name" value="<?php echo $result["member_name"]; ?>">

<input type="hidden" id="member_uid" name="member_uid" value="<?php echo $result["member_uid"]; ?>">


<input type="hidden" id="member_id" name="member_id" value="<?php echo $result["member_id"]; ?>">
              
<button type="button" class="btn btn-success"  onclick="confirmalert(event);" >send message</button>

</form>
</div>

</div>  </div>




</div>


<script>
function confirmalert(e) {
	e.preventDefault();
	var frm = e.target.form;
	swal({
    title: 'Are you sure?',
    text: "ยืนยันที่จะส่ง Push Message!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: 'btn btn-success',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Confirm!'
}).then((result) => {
		if (result.value) {

			frm.submit(); // <--- submit form programmatically
		} else {
			swal("ยกเลิกการส่งข้อความ !" , "กลับสู่หน้าแก้ไข", "error");
		}
	})
}
</script>



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