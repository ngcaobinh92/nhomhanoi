window.onload = function () {
  var txtPassword = document.getElementById("password");
  var txtConfirmPassword = document.getElementById("re_password");
  txtPassword.onchange = ConfirmPassword;
  txtConfirmPassword.onkeyup = ConfirmPassword;
  function ConfirmPassword() {
    txtConfirmPassword.setCustomValidity("");
    if (txtPassword.value != txtConfirmPassword.value) {
      txtConfirmPassword.setCustomValidity("Mật khẩu không trùng khớp!");
    }
  }
}

$('#user_form').validate({
  rules: {
    avatar: {
      required: true,
      extension:'jpe?g,png,gif',
      uploadFile:true,
    }
  }
});

$('.avatar-wrapper').on('click', function() {
  $('#file-upload').click();
});

function fasterPreview( uploader ) {
  if ( uploader.files && uploader.files[0] ){
    $('#profileImage').attr('src', window.URL.createObjectURL(uploader.files[0]) );
  }
}

$("#file-upload").change(function(){
  fasterPreview( this );
});