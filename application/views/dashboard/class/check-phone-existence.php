<script>
    function isPhoneExist(contact,operation,id_user){
        let is_cpExist = false;
        $.ajax({
            type: 'ajax',
            method: 'post',
            url: '<?php echo base_url()?>user/validatePhone',
            data:{
                contact:contact,
                operation:operation,
                id:id_user
                },
            async: false,
            dataType: 'text',
            success: function(response){
                if(response == 'true'){
                    is_cpExist = true;
                }
            },
            error: function(){
                swal('Something went wrong');
            }
        });

        if(is_cpExist == true){
            return true;
        }
        return false;

    }
</script>