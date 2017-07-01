<?php $data = $this->EMRModel->generate_id(); ?>
<?php $register = $this->EMRModel->getRegisterID($_SESSION['doctor_id']); ?>

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
                    <span class="highlight">Add Medical Record</span>
                </div>
                <div class="col-md-3">
                    <input type="submit" form="forminput" class="btn btn-primary" value="Save" />
                    <button type="reset" form="forminput" class="btn btn-default">Reset</button>
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
                    <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Detail</a>
                    </li>
                    <li role="tab3">
                    <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Vitals</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <?= form_open('', 'class="form form-horizontal" id="forminput"'); ?>
                    <div role="tabpanel" class="tab-pane active" id="tab1">
                        <div class="section">
                            <div class="section-title">Medical Record Information</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Record ID*</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $data; ?>" class="form-control" placeholder="RecordID" name="record_id" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Registration ID*</label>
                                    <div class="col-md-9">
                                        <?php
                                            echo "<select class='select2' style='width: 100%;' name='register_id' id='register_id' required>";
                                            echo "<option value=''>Select Registration</option>";
                                            foreach ($register as $list) {
                                                echo "<option value='". $list['register_id'] . "'>" . $list['register_id'] . " - " . $list['patient_name'] . "</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Additional Notes</label>
                                    <div class="col-md-9">
                                        <textarea name="additional_notes" class="form-control" id="textarea-gui"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab2">
                        <div class="section">
                            <div class="section-title">Medical Record Detail</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Complaints*</label>
                                    <div class="col-md-9">
                                        <textarea name="complaint" class="form-control" id="textarea-gui2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Symptoms*</label>
                                    <div class="col-md-9">
                                        <textarea name="symptoms" class="form-control" id="textarea-gui3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Diagnosis*</label>
                                    <div class="col-md-9">
                                        <textarea name="diagnosis" class="form-control" id="textarea-gui4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Handling*</label>
                                    <div class="col-md-9">
                                        <textarea name="handling" class="form-control" id="textarea-gui5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab3">
                        <div class="section">
                            <div class="section-title">Medical Record Vital Data</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Weight</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">kg</span>
                                            <input type="number" class="form-control" name="weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Height</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">cm</span>
                                            <input type="number" class="form-control" name="height">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Blood Pressure Systolic</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">mmHg</span>
                                            <input type="number" class="form-control" name="blood_pressure_systolic">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Blood Pressure Diastolic</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">mmHg</span>
                                            <input type="number" class="form-control" name="blood_pressure_diastolic">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pulse</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">per min</span>
                                            <input type="number" class="form-control" name="pulse">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Respiration</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">per min</span>
                                            <input type="number" class="form-control" name="respiration">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Temperature</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">C</span>
                                            <input type="number" class="form-control" name="temperature">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Temperature Location</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="select2" style="width:100%;" name="temperature_location">
                                                <option value="0">Unspecified</option>
                                                <option value="1">Rectal Temperature</option>
                                                <option value="2">Oral Temperature</option>
                                                <option value="3">Axillary Temperature</option>
                                                <option value="4">Tympanic Temperature</option>
                                                <option value="5">Vaginal Temperature</option>
                                                <option value="6">Bladder</option>
                                                <option value="7">Temporal Artery</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Oxygen Saturation</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input type="number" class="form-control" min="0" max="100" name="oxygen_saturation">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Head Circumference</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">cm</span>
                                            <input type="number" class="form-control" name="head_circumference">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Waist Circumference</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">cm</span>
                                            <input type="number" class="form-control" name="waist_circumference">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">BMI</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <span class="input-group-addon">kg/m^2</span>
                                            <input type="number" class="form-control" name="bmi">
                                        </div>
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