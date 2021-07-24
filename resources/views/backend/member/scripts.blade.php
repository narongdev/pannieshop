<script>
    $(document).ready (function(){
    
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
        });

        $('#filter').change(function(){
            window.location.href = '{{ url('/backend/member/recommend')}}/' + this.value;
        });

        $('#search').keyup(function(e){
            if(e.keyCode==13){
                if(this.value != '') window.location.href = '{{ url('/backend/member/search')}}/' + this.value;
            }else{
                return false;
            }
        });
    
    }); 

    // Confirm Delete
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-confirm').attr('href', $(e.relatedTarget).data('href'));
    });

    //////////////////////// Create //////////////////////
    function beforeSubmitADD(){
        
        if($('#inputMem').val()==''){
            alertText('Please enter First Name!');  
            return false;
        }
        
        $('#frmInfor').submit();

    }

    //////////////////////// Edit //////////////////////
    function beforeSubmitEDIT(){ 
        if($('#inputMem').val()==''){
            alertText('Please enter First Name!');  
            return false;
        }
        
        $('#frmInfor').submit();
    }

       
</script>