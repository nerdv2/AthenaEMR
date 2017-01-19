<!DOCTYPE HTML>
<html>
  <head>
    <style>
      body {
        margin: 0px;
        padding: 0px;
      }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
<script type="text/javascript" src="<?php echo base_url("/assets/js/jquery.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("/assets/js/jquery-qrcode-0.14.0.js"); ?>"></script>
  </head>
  <body>
    <canvas id="myCanvas" width="353" height="206"></canvas><br><br>
    QR CODE:<br>
    <canvas id="qrcodeCanvas"></canvas>
    <script>
        jQuery('#qrcodeCanvas').qrcode({
            render: 'canvas',
            text	: "<?= $query->id_pasien; ?>",
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
        context.fillText("<?= $query->nama_pasien; ?>", 30, 90);
        context.fillText("<?= $query->id_pasien; ?>", 30, 120);

        imageObj2.src = document.getElementById('qrcodeCanvas').toDataURL();
        imageObj2.onload = function() {
            context.drawImage(imageObj2, 220, 40);
   };
        
      };
      imageObj.src = '<?php echo base_url("/assets/img/card_template.png"); ?>';
      
      
    </script>
  </body>
</html>  