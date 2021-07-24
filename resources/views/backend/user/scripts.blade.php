<script>
    $(document).ready (function(){
    
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
        });

        $('#filter').change(function(){
            window.location.href = '{{ url('/backend/user/type')}}/' + this.value;
        });
    
    }); 

    // Confirm Delete
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-confirm').attr('href', $(e.relatedTarget).data('href'));
    });

    //////////////////////// Create //////////////////////
    function beforeSubmitADD(){

        if($('#inputUser').val()==''){
            alertText('Please input Username!');  
            return false;
        }
        if($('#inputPass').val()==''){
            alertText('Please input password!');
            return false;
        }else if($('#inputPass').val()!=$('#inputPass2').val()){
            alertText('Password not match!');
            return false;
        }else{
            $('#frmInfor').submit();
        }

    }

    //////////////////////// Edit //////////////////////
    function beforeSubmitEDIT(){ 
        if($('#inputPass').val()!=''){
            if($('#inputPass').val()!=$('#inputPass2').val()){
                alertText('Password not match!');
                return false;
            }else{
                $('#frmInfor').submit();
            }            
        }else{
            $('#frmInfor').submit();
        }
    }

       
</script>