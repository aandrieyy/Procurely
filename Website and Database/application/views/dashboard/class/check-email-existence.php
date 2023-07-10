<script>
    function isEmailExist(email,operation,id_user){
        let is_emailExist = false;
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: '<?php echo base_url()?>user/validateEmail',
            data:{
                email:email,
                operation:operation,
                id:id_user
                },
            async: false,
            dataType: 'text',
            success: function(response){
                if(response == 'true'){
                    is_emailExist = true;
                }
            },
            error: function(){
                swal('Something went wrong');
            }
        });

        if(is_emailExist == true){
            return true;
        }
        return false;

    }
</script>