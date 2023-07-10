<script>
    function accept_number_only(id_textfield){
        let id = "#"+id_textfield;
        $(id).on('keyup',function(){
            this.value=this.value.replace(/[^\d]/,'');
        })
    }
</script>