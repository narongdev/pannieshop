<script>
    $(document).ready (function(){
    
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
        });

        $('#catagory').change(function(){
            window.location.href = '{{ url('/backend/products/catagory')}}/' + this.value;
        });
        $('#filter').change(function(){
            window.location.href = '{{ url('/backend/products/recommend')}}/' + this.value;
        });

        // Editor
        $('.summernote').summernote({
            height: 300,
            tabsize: 2,
            followingToolbar: true,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['picture'],['link']
            ]
            
        });
    
    }); 

    // Confirm Delete
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-confirm').attr('href', $(e.relatedTarget).data('href'));
    });

    //////////////////////// Create //////////////////////
    function beforeSubmitADD(){
        
        if($('#inputPro').val()==''){
            alertText('Please enter Products!');  
            return false;
        }
        if($('input[name="catagory[]"]:checked').length == 0){
            alertText('Please select a Catagory!');  
            return false;
        }
        if($('#inputPrice').val()==''){
            alertText('Please enter Price!');  
            return false;
        }
        if($('#inputStock').val()==''){
            alertText('Please enter Stock!');  
            return false;
        }
        
        $('#frmInfor').submit();

    }

    //////////////////////// Edit //////////////////////
    function beforeSubmitEDIT(){ 
        if($('#inputPro').val()==''){
            alertText('Please enter Products!');  
            return false;
        }
        if($('input[name="catagory[]"]:checked').length == 0){
            alertText('Please select a Catagory!');  
            return false;
        }
        if($('#inputPrice').val()==''){
            alertText('Please enter Price!');  
            return false;
        }
        if($('#inputStock').val()==''){
            alertText('Please enter Stock!');  
            return false;
        }
        
        $('#frmInfor').submit();
    }
       
</script>