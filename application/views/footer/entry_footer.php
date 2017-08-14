
  <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/select2.full.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.datatables.min.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/dataTables.bootstrap.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/chartist.min.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/highlight.pack.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.autocomplete.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/perfect-scrollbar.jquery.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("/assets/js/jquery-qrcode-0.14.0.js"); ?>"></script>

  <script>
                jQuery('#qrcodeCanvas').qrcode({
                    render: 'canvas',
                    text	: "<?= $query->register_id; ?>",
                    size: 100
                });	
            </script>

            
            <script>
            
              var canvas = document.getElementById('myCanvas');
              var context = canvas.getContext('2d');
              var imageObj = new Image();
              var imageObj2 = new Image();

              imageObj.onload = function() {
                context.drawImage(imageObj, 0, 0);
                context.font = "bold 8pt Segoe UI";
                context.fillStyle = "black";
                context.fillText("AthenaEMR", 100, 60);
                context.font = "100pt Segoe UI";
                context.fillStyle = "black";
                context.fillText("<?= $query->entry_no; ?>", 100, 180);
                context.font = "12pt Segoe UI";
                context.fillText("<?= $query->register_id; ?>", 70, 220);

                
              };
              imageObj.src = '<?php echo base_url("/assets/img/entry_template.png"); ?>';
              
              
            </script>
</body>
</html>