$(document).ready(function () {
    $("#myForm").click(function () {
        $custom = $('input[name=percentage]:checked', '#myForm').val();
        if ($custom == "custom") {
            $('#custom').prop('disabled', false);
        } else {
            $('#custom').prop('disabled', true);
        }
    });
});
