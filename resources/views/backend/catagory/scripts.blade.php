<script>
    $(document).ready (function(){
    
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
        });

        $('#filter').change(function(){
            window.location.href = '{{ url('/backend/catagory/recommend')}}/' + this.value;
        });
    
    }); 

    // Confirm Delete
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-confirm').attr('href', $(e.relatedTarget).data('href'));
    });

    //////////////////////// Create //////////////////////
    function beforeSubmitADD(){
        
        if($('#inputCat').val()==''){
            alertText('Please enter Catagory!');  
            return false;
        }
        
        $('#frmInfor').submit();

    }

    //////////////////////// Edit //////////////////////
    function beforeSubmitEDIT(){ 
        if($('#inputCat').val()==''){
            alertText('Please enter Catagory!');  
            return false;
        }
        
        $('#frmInfor').submit();
    }

       
</script>