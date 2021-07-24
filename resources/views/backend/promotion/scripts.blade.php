<script>
    $(document).ready (function(){
    
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
        });

        $('#filter').change(function(){
            window.location.href = '{{ url('/backend/promotion/recommend')}}/' + this.value;
        });

        $('#search').keyup(function(e){
            if(e.keyCode==13){
                if(this.value != '') window.location.href = '{{ url('/backend/promotion/search')}}/' + this.value;
            }else{
                return false;
            }
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
                ['fontsize', ['fontsize', 'fontsizeunit']],
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
            alertText('Please enter Promotion!');  
            return false;
        }
        
        $('#frmInfor').submit();

    }

    //////////////////////// Edit //////////////////////
    function beforeSubmitEDIT(){ 
        if($('#inputPro').val()==''){
            alertText('Please enter Promotion!');  
            return false;
        }
        
        $('#frmInfor').submit();
    }

       
</script>