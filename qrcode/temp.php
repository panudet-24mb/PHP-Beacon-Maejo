<!DOCTYPE html>
<html>
<head>
	<title>maejo beacon system</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="instascan.min.js"></script>
</head>
<body>
    <h1>Scan base</h1>
    <video id="preview"></video>

    <input type='text' id='yourInputFieldId' />


    <div class="search-box">
        <input type="text" autocomplete="off"  id='valueinputbox'  placeholder="Search member..." />
        <div class="result"></div>
    </div>



    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),mirror: false });
      scanner.addListener('scan', function (content) {
        document.getElementById("valueinputbox").value = content; // Pass the scanned content value to an input field
        alert(content);
    });
       
 
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
    var selectedCam = cameras[0];
    $.each(cameras, (i, c) => {
        if (c.name.indexOf('back') != -1) {
            selectedCam = c;
            return false;
        }
    });

    scanner.start(selectedCam);
} else {
    console.error('No cameras found.');
}
      }).catch(function (e) {
        console.error(e);
      });
    </script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>


</body>
</html>