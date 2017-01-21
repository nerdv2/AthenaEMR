
<div class="row">
  <?php if (validation_errors()) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			<div class="col-md-12">
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			</div>
		<?php endif; ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Registration Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control"  name="start" placeholder="Start Date" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                    <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker').datetimepicker({
                                    viewMode: 'years',
                                    format: 'MM-YYYY'
                                });
                            });
                    </script>
                </div>
                <div class="col-md-12">
                     <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control"  name="end" placeholder="End Date" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                    <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker2').datetimepicker({
                                    viewMode: 'years',
                                    format: 'MM-YYYY'
                                });
                            });
                    </script>
                </div>
                <div class="form-footer">
                  <div class="form-group">
                    <div class="col-md-9">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                  </div>
                 </div>
            </div>
        </div>
    </div>
  </div>
</div>
