
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
    <?php $patient = $this->EMRModel->getPatientID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Patient Medical Record Data
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
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' style='width: 100%;' name='patient_id' id='patient_id'>";
                      echo "<option value=''>Select Patient</option>";
                      foreach ($patient as $list) {
                        echo "<option value='". $list['patient_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
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
