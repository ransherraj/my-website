$(document).ready(function(e){



    let $uploadfile = $('#profileimageupload');

    $uploadfile.change(function(){
        readURL(this);
    })

    $("#reg-form").submit(function(event){
        let $password = $("#password");
        let $confirmpassword = $("#cpassword");
        let $error = $("#confirm_error");
        if($password.val() === $confirmpassword.val()){
            return true;
        }
        else{
            $error.text("Password not maches");
            event.preventDefault();
        }
    })
})


function readURL(input){
    if(input.files && input.files[0]){
        let reader = new FileReader();
        reader.onload = function(e){
            $("#profileimage").attr('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}