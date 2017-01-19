
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
          Medical Record Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="RecordID" value="<?= $query->record_id; ?>" name="record_id" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="DoctorID" value="<?= $query->doctor_id; ?>" name="doctor_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="RegisterID" value="<?= $query->register_id; ?>" name="register_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="PatientID" value="<?= $query->patient_id; ?>" name="patient_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="LabID" value="<?= $query->lab_id; ?>" name="lab_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="LabResultID" value="<?= $query->result_id; ?>" name="result_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="PrescriptionID" value="<?= $query->prescription_id; ?>" name="prescription_id" required>
                </div>
                <div class="col-md-12">
                     <textarea name="complaint" class="form-control"><?= $query->complaint; ?></textarea>
                </div>
                <div class="col-md-12">
                     <textarea name="symptoms" class="form-control"><?= $query->symptoms; ?></textarea>
                </div>
                <div class="col-md-12">
                     <textarea name="diagnosis" class="form-control"><?= $query->diagnosis; ?></textarea>
                </div>
                <div class="col-md-12">
                     <textarea name="handling" class="form-control"><?= $query->handling; ?></textarea>
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
