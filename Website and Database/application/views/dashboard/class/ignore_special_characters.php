<script>
//TO ACTIVATE THIS CODE
//PUT THIS CODE ON EVERY TEXTBOX YOU WANT
//oninput="javascript:validate(this.id,this.value)"
function validate(id,value) {
    var rgx = /^[a-zA-Z0-9 ]*$/;
    
    if(!rgx.test(value)) {
       swal('Special Character is not allowed','','error');
       
       var filtered_input = value.replace(/[^a-zA-Z ]/g, "");
       
       document.getElementById(id).value = filtered_input;
       numberVar.focus();
    } 
}
</script>