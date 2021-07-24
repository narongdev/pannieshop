/*!
    * Start Bootstrap - SB Admin v7.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

var alertText = (text)=>{
    $('#alertModal').modal('show');
    $('#alert-text').html(text);
}

var imgTypes = ['jpg', 'jpeg', 'png'];
function previewImg(input) {
    if (input.files && input.files[0]) {        
        var extFile = input.files[0].name.split('.').pop().toLowerCase();
        var isSuccess = imgTypes.indexOf(extFile) > -1;

        if (isSuccess) {
            var reader = new FileReader();
            reader.onload = function(e) {      
                var preview = '<img src="'+ e.target.result +'" width="100%">';
                $('#preview').html(preview);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }else{
            // warning
            alertText('Files can be uploaded include "jpg, jpeg, png" ');
            $(input).val('');
        }
    }
}