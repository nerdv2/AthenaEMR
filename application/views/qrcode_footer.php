

  <script type="text/javascript" src="<?php echo base_url("assets/js/vendor.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("/assets/js/jquery-qrcode-0.14.0.js"); ?>"></script>

  <script>
                jQuery('#qrcodeCanvas').qrcode({
                    render: 'canvas',
                    text	: "<?= $query->patient_id; ?>",
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
                context.font = "bold 12pt Segoe UI";
                context.fillStyle = "white";
                context.fillText("AthenaEMR ID Card", 5, 30);
                context.font = "14pt Segoe UI";
                context.fillStyle = "black";
                context.fillText("<?= $query->name; ?>", 30, 90);
                context.fillText("<?= $query->patient_id; ?>", 30, 120);

                imageObj2.src = document.getElementById('qrcodeCanvas').toDataURL();
                imageObj2.onload = function() {
                    context.drawImage(imageObj2, 220, 40);
          };
                
              };
              imageObj.src = '<?php echo base_url("/assets/img/card_template.png"); ?>';
              
              
            </script>
</body>
</html>