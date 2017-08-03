
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
    <?php $data = $this->RegistrationModel->generate_id(); ?>
    <?php $worker = $this->RegistrationModel->getWorkerID($_SESSION['worker_id']); ?>
    <?php $patient = $this->RegistrationModel->getPatientID(); ?>
    <?php $clinic = $this->RegistrationModel->getClinicID(); ?>
    <?php //$doctor = $this->RegistrationModel->getDoctorID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Registration Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="RegisterID" name="register_id" readonly required>
                </div>
                <div class="col-md-12">
                     <?php
                     if($_SESSION['status'] == "ADMIN"){
                        echo "<select class='select2' style='width: 100%;' name='worker_id' id='worker_id'>";
                        echo "<option value='ADMIN'>ADMINISTRATOR</option>";
                     } else {
                        echo "<select class='select2' style='width: 100%;' name='worker_id' id='worker_id'>";
                        //echo "<option value=''>Select Worker</option>";
                        foreach ($worker as $list) {
                        echo "<option value='". $list['worker_id'] . "'>" . $list['name'] . "</option>";
                      }
                     }
                        
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                  <div class="radio">
                      <input type="radio" name="patient_type" id="radio3" value="1" checked>
                      <label for="radio3">
                          New Patient
                      </label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="radio">
                      <input type="radio" name="patient_type" id="radio4" value="0">
                      <label for="radio4">
                          Existing Patient
                      </label>
                  </div>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' style='width: 100%;' name='patient_id' id='patient_id'>";
                      echo "<option value=''>Select Patient</option>";
                      foreach ($patient as $list) {
                        echo "<option value='". $list['patient_id'] . "'>" . $list['patient_id'] . " " . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <input type="hidden" name="category" value="clinic">
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' style='width: 100%;' name='clinic_id' id='clinic_id'>";
                      echo "<option value=''>Select Clinic</option>";
                      foreach ($clinic as $list) {
                        echo "<option value='". $list['clinic_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12 hide" id="input_doctor">
                     
                     <?php
                     /*
                      echo "<select class='select2' name='doctor_id' id='doctor_id'>";
                      echo "<option value=''>Select Doctor</option>";
                      foreach ($doctor as $list) {
                        echo "<option value='". $list['doctor_id'] . "'>" . $list['name'] . "</option>";
                      }
                      */
                    ?>

                    <select class='select2' style='width: 100%;' name='doctor_id' id='doctor_id'>
                    
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
