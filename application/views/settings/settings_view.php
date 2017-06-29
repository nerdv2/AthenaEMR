
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

<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <div class="app-title">
            <div class="title">
                <div class="col-md-9">
                    <span class="highlight">Change Application Settings</span>
                </div>
                <div class="col-md-3">
                    <input type="submit" form="forminput" class="btn btn-primary" value="Save" />
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-tab">
            <div class="card-header">
                <ul class="nav nav-tabs">
                    <li role="tab1" class="active">
                    <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Info</a>
                    </li>
                    <li role="tab2">
                    <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Data ID</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <?= form_open('', 'class="form form-horizontal" id="forminput"'); ?>
                    <div role="tabpanel" class="tab-pane active" id="tab1">
                        <div class="section">
                            <div class="section-title">Hospital Information</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Hospital Name*</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->hospital_name; ?>" class="form-control" placeholder="Hospital Name" name="hospital_name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Hospital Address*</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="textarea-gui" name="hospital_address"><?= $query->hospital_address; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Hospital Phone*</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->hospital_phone; ?>" class="form-control" placeholder="Hospital Phone" name="hospital_phone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Hospital Email*</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->hospital_email; ?>" class="form-control" placeholder="Hospital Email" name="hospital_email" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab2">
                        <div class="section">
                            <div class="section-title">Entry Data ID</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Worker ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->worker_id_prefix; ?>" class="form-control" placeholder="Worker ID Prefix" name="worker_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Doctor ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->doctor_id_prefix; ?>" class="form-control" placeholder="Doctor ID Prefix" name="doctor_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Register ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->register_id_prefix; ?>" class="form-control" placeholder="Register ID Prefix" name="register_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Clinic ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->clinic_id_prefix; ?>" class="form-control" placeholder="Clinic ID Prefix" name="clinic_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Payment ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->payment_id_prefix; ?>" class="form-control" placeholder="Payment ID Prefix" name="payment_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Patient ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->patient_id_prefix; ?>" class="form-control" placeholder="Patient ID Prefix" name="patient_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Medical Record ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->record_id_prefix; ?>" class="form-control" placeholder="Medical Record ID Prefix" name="record_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Lab ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->lab_id_prefix; ?>" class="form-control" placeholder="Lab ID Prefix" name="lab_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Lab Result ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->result_id_prefix; ?>" class="form-control" placeholder="Lab Result ID Prefix" name="result_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Prescription ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->prescription_id_prefix; ?>" class="form-control" placeholder="Prescription ID Prefix" name="prescription_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Medicine ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->medicine_id_prefix; ?>" class="form-control" placeholder="Medicine ID Prefix" name="medicine_id_prefix" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Medicine Type ID Prefix</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $query->medicine_type_prefix; ?>" class="form-control" placeholder="Medicine Type ID Prefix" name="medicine_type_prefix" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>