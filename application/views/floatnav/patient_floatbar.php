<?php
if($_SESSION['role'] == "admin" or $_SESSION['role'] == "REGISTRATION"){
?>
<a href="<?php echo base_url("index.php/patient/add"); ?>">
<div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
    <i class="icon fa fa-plus"></i>
    <span class="help-text">Shortcut</span>
  </button>
</div>
</a>
<?php
}
?>