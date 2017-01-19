
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
    <?php $doctor = $this->RegistrationModel->getDoctorID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Patient Visit Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="From (example: 01-2017)" name="start" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="To (example: 02-2017)" name="end" required>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='doctor_id' id='doctor_id'>";
                      echo "<option value=''>Select Doctor</option>";
                      foreach ($doctor as $list) {
                        echo "<option value='". $list['doctor_id'] . "'>" . $list['name'] . "</option>";
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
