
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
    <?php $doctor = $this->EMRModel->getDoctorID(); ?>
    <?php $register = $this->EMRModel->getRegisterID(); ?>
    <?php $patient = $this->EMRModel->getPatientID(); ?>
    <?php $lab = $this->EMRModel->getLabID(); ?>
    <?php $labresult = $this->EMRModel->getLabResultID(); ?>
    <?php $prescription = $this->EMRModel->getPrescriptionID(); ?>
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
                      echo "<select class='select2' name='doctor_id' id='doctor_id'>";
                      echo "<option value=''>Select Doctor</option>";
                      foreach ($doctor as $list) {
                        echo "<option value='". $list['doctor_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='register_id' id='register_id'>";
                      echo "<option value=''>Select Registration</option>";
                      foreach ($register as $list) {
                        echo "<option value='". $list['register_id'] . "'>" . $list['register_id'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='patient_id' id='patient_id'>";
                      echo "<option value=''>Select Patient</option>";
                      foreach ($patient as $list) {
                        echo "<option value='". $list['patient_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='lab_id' id='lab_id'>";
                      echo "<option value=''>Select Lab</option>";
                      foreach ($lab as $list) {
                        echo "<option value='". $list['lab_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='result_id' id='result_id'>";
                      echo "<option value=''>Select Lab Result</option>";
                      foreach ($labresult as $list) {
                        echo "<option value='". $list['result_id'] . "'>" . $list['result_id'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='prescription_id' id='prescription_id'>";
                      echo "<option value=''>Select Prescription</option>";
                      foreach ($prescription as $list) {
                        echo "<option value='". $list['prescription_id'] . "'>" . $list['prescription_id'] . "</option>";
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
