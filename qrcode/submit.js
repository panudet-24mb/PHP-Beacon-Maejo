function SubmitFormData() {
    var name = $("#uid").val();
    $.post("updatebeaconlevel1.php", { uid:uid },
    function(data) {
	 $('#results').html(data);
	 $('#myForm')[0].reset();
    });
}