
//summernote scripts
$(document).ready(function() {

    var user_href;
    var user_href_splitted;
    var user_id;
    var image_src;
    var image_href_splitted;
    var image_name;
    var photo_id;


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
        image_name =image_href_splitted[image_href_splitted.length - 1]; //get the value

        $photo_id = $(this).attr("data");

        $.ajax({
            url: "includes/ajax_code.php",
            data:{photo_id:photo_id},
            type:"POST",
            success:function (data) {
                if (!data.error){
                    //replace source to image
                    $("#modal_sidebar").html(data);

                }
            }
        });


    });

    $("#set_user_image").click(function () {

        $.ajax({
            url: "includes/ajax_code.php",
            data:{image_name: image_name, user_id:user_id },
            type:"POST",
            success:function (data) {
                if (!data.error){
                    //replace source to image
                    $(".user_image_box a img").prop('src', data);
                    //location.reload(true);
                }
            }
        });

    });


    $('#summernote').summernote({
        height:300
    });

    /**Edit photo**/
    $(".info-box-header").click(function () {
        $(".inside").slideToggle("fast");
        $("#toggle").toggleClass("glyphicon-menu-down glyphicon,glyphicon-menu-up glyphicon");
    });

    /**Delete function **/
    $(".delete_button").click(function () {

        return confirm("Are you sure you want to delete this item");

    });
    
});



