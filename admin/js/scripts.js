
//summernote scripts
$(document).ready(function() {

    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_href_splitted;
    var image_id;

    $('#summernote').summernote({
        height:300
    });

    //Photo Library


    $(".modal_thumbnails").click(function () {

        //Enable the button to true
        $("#set_user_image").prop('disabled',false);

        //Grap user_id
        $(this).addClass('selected')
        user_href = $("#user-id").prop('href');
        user_href_splitted = user_href.split("=");//array
        user_id =user_href_splitted[user_href_splitted.length - 1]; //get the value



        image_src = $(this).prop("src");
        image_href_splitted = image_src.split("/");//array
        image_id =image_href_splitted[image_href_splitted.length - 1]; //get the value

        alert(image_id);
    });
});



