<script>
    function accept_money_only(id_textfield){
        let id = "#"+id_textfield;
        $(id).on('input',function(){
            this.value = this.value.replace(/[^0-9.]/g,'');
            this.value = this.value.replace(/(\..*)\./g, '');
        })
    }
</script>