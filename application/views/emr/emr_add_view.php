
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
    <?php $data = $this->EMRModel->generate_id(); ?>
    <?php $register = $this->EMRModel->getRegisterID($_SESSION['doctor_id']); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Medical Record Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="RecordID" name="record_id" required>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='register_id' id='register_id'>";
                      echo "<option value=''>Select Registration</option>";
                      foreach ($register as $list) {
                        echo "<option value='". $list['register_id'] . "'>" . $list['register_id'] . " - " . $list['patient_name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <textarea name="complaint" class="form-control">Complaints</textarea><br>
                </div>
                <div class="col-md-12">
                     <textarea name="symptoms" class="form-control">Symptoms</textarea><br>
                </div>
                <div class="col-md-12">
                     <textarea name="diagnosis" class="form-control">Diagnosis</textarea><br>
                </div>
                <div class="col-md-12">
                     <textarea name="handling" class="form-control">Handling</textarea><br>
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
