
//summernote scripts
$(document).ready(function() {
    $('#summernote').summernote({
        height:300
    });

    //Photo Library

    $(".modal_thumbnails").click(function () {
        //Enable the button to true
        $("#set_user_image").prop('disabled',false);
    });
});



