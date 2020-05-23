  
  <footer class="app-footer"> 
    <div class="row">
      <div class="col-xs-12">
        <div class="footer-copyright">
          Copyright © 2020 Gema Aji Wardian, All right reserved.
        </div>
      </div>
    </div>
  </footer>
</div>

  <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/select2.full.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.datatables.min.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/dataTables.bootstrap.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/chartist.min.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/highlight.pack.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.autocomplete.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/perfect-scrollbar.jquery.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/app.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/moment.min.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap3-typeahead.js"); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>

  <script type="text/javascript">
    $('#clinic_id').change(function(){
        $("#input_doctor").removeClass("hide");

        var clinic_id = $(this).val();
        $("#doctor_id > option").remove();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('registration/getDoctor'); ?>",
            data: {id: clinic_id},
            dataType: 'json',
            success:function(data){
                $.each(data,function(k, v){
                    var opt = $('<option />');
                    opt.val(k);
                    opt.text(v);
                    $('#doctor_id').append(opt);
                });
                //$('#state').append('<option value="' + id + '">' + name + '</option>');
            }
        });
    });
  </script>
</body>
</html>