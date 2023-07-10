<?php  
if($this->session->userdata('status_msg')){
?>
      <script>
          swal('<?= $_SESSION['status_msg']?>','','<?= $_SESSION['status_type']?>');
      </script>
<?php
unset($_SESSION['status_msg']);	
unset($_SESSION['status_type']);	
}
?>