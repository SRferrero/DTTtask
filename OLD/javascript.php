
<script>
var error =  "<?php echo $_SESSION["error"]; ?>";

$(document).ready(function () {
  if(typeof error === 'string'){
    swal({title: "Error!",   text: error,   type: "error",   confirmButtonText: "Try again" });
  }
});

</script>
