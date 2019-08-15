<?php



$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";


$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
mysqli_set_charset($objCon, "utf8");

$strSQL = "SELECT * FROM websiteinfo WHERE websiteinfo_id = 1";
$objQuery = mysqli_query($objCon, $strSQL);
$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Maejo University Line Beacon</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/freelancer.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top" > <img src="img/Logo.png" width="20%" height="20%"/> Maejo Beacon </a>
     
     
  </nav>

  <!-- Header -->
  <header class="masthead bg-primary text-white text-center">
    <div class="container">
     <!--   --> <img class="img-fluid mb-5 d-block mx-auto" src="img/img1.png" alt="">
      <h1 class="text-uppercase mb-0"> <?php echo html_entity_decode($objResult["websiteinfo_header"]);?>
 </h1>
      <hr class="star-light">
      <div align="center">
          
      <?php echo html_entity_decode($objResult["websiteinfo_main_content"]);?>

      </div>
    </div>
  </header>

  <!-- Portfolio Grid Section -->
  <section class="portfolio" id="portfolio">
    <div class="container">
      <h2 class="text-center text-uppercase text-secondary mb-0"> <?php echo html_entity_decode($objResult["websiteinfo_sub_header"]);?> </h2>
      <hr class="star-dark mb-5">
      <?php echo html_entity_decode($objResult["websiteinfo_sub_content"]);?>
    </div>
  </section>

  <!-- About Section -->
  <section class="bg-primary text-white mb-0" id="about">
    <div class="container">
    <h2 class="text-center text-uppercase text-secondary mb-0"> <?php echo html_entity_decode($objResult["websiteinfo_below_header"]);?> </h2>
      <hr class="star-light mb-5">
      <div class="row">
      <?php echo html_entity_decode($objResult["websiteinfo_below_content"]);?>
    </div>
  </section>

 

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4"> มหาวิทยาลัยแม่โจ้-แพร่ เฉลิมพระเกียรติ</h4>
                    <p class="lead mb-0">
         
            เลขที่ 17 หมู่ที่ 3 ต.แม่ทราย อ.ร้องกวาง จ.แพร่ 54140 <br>

            เบอร์โทรศัพท์ 0 5464 8593-5   เบอร์โทรสาร 0 5464 8374 , 0 5464 8596 <br>

            เว็บไซต์นี้แสดงผลได้ดีบนเบราเซอร์ Google Chrome
          </p>
        </div>
        <div class="col-md-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4">Around the Web</h4>
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-facebook-f"></i>
              </a>
            </li>
        
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
              <i class="fab fa-youtube"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h4 class="text-uppercase mb-4">คำแนะนำ</h4>
          <p class="lead mb-0"> เว็บไซต์นี้แสดงผลได้ดีบนเบราเซอร์ Google Chrome
           
        </div>
      </div>
    </div>
  </footer>

  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright &copy; MAEJO - Beacon System</small>
    </div>
  </div>

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Portfolio Modals -->

  <!-- Portfolio Modal 1 -->
  <div class="portfolio-modal mfp-hide" id="portfolio-modal-1">
    <div class="portfolio-modal-dialog bg-white">
      <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
        <i class="fa fa-3x fa-times"></i>
      </a>
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
            <hr class="star-dark mb-5">
            <img class="img-fluid mb-5" src="img/portfolio/cabin.png" alt="">
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
            <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
              <i class="fa fa-close"></i>
              Close Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 2 -->
  <div class="portfolio-modal mfp-hide" id="portfolio-modal-2">
    <div class="portfolio-modal-dialog bg-white">
      <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
        <i class="fa fa-3x fa-times"></i>
      </a>
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
            <hr class="star-dark mb-5">
            <img class="img-fluid mb-5" src="img/portfolio/cake.png" alt="">
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
            <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
              <i class="fa fa-close"></i>
              Close Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 3 -->
  <div class="portfolio-modal mfp-hide" id="portfolio-modal-3">
    <div class="portfolio-modal-dialog bg-white">
      <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
        <i class="fa fa-3x fa-times"></i>
      </a>
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
            <hr class="star-dark mb-5">
            <img class="img-fluid mb-5" src="img/portfolio/circus.png" alt="">
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
            <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
              <i class="fa fa-close"></i>
              Close Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 4 -->
  <div class="portfolio-modal mfp-hide" id="portfolio-modal-4">
    <div class="portfolio-modal-dialog bg-white">
      <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
        <i class="fa fa-3x fa-times"></i>
      </a>
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
            <hr class="star-dark mb-5">
            <img class="img-fluid mb-5" src="img/portfolio/game.png" alt="">
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
            <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
              <i class="fa fa-close"></i>
              Close Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 5 -->
  <div class="portfolio-modal mfp-hide" id="portfolio-modal-5">
    <div class="portfolio-modal-dialog bg-white">
      <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
        <i class="fa fa-3x fa-times"></i>
      </a>
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
            <hr class="star-dark mb-5">
            <img class="img-fluid mb-5" src="img/portfolio/safe.png" alt="">
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
            <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
              <i class="fa fa-close"></i>
              Close Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modal 6 -->
  <div class="portfolio-modal mfp-hide" id="portfolio-modal-6">
    <div class="portfolio-modal-dialog bg-white">
      <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
        <i class="fa fa-3x fa-times"></i>
      </a>
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-secondary text-uppercase mb-0">Project Name</h2>
            <hr class="star-dark mb-5">
            <img class="img-fluid mb-5" src="img/portfolio/submarine.png" alt="">
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
            <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
              <i class="fa fa-close"></i>
              Close Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/freelancer.min.js"></script>

</body>

</html>
