
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
    <?php $dokter = $this->UsersModel->getDoctorID(); ?>
    <?php $petugas = $this->UsersModel->getWorkerID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Users Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                <div class="col-md-12">
                     <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="col-md-12">
                     <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" required>
                </div>
                <div class="col-md-12">
                     <select class="select2" name="status">
                        <option value="admin">Administrator</option>
                        <option value="doctor">Doctor</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="payment">Payment Administration</option>
                        <option value="registration">Registration Administration</option>
                        <option value="lab">Lab Administration</option>
                     </select>
                </div>
                <div class="col-md-12">
                    <?php
                      echo "<select class='select2' name='doctor_id' id='doctor_id'>";
                      echo "<option value=''>Select Doctor</option>";
                      foreach ($dokter as $list) {
                        echo "<option value='". $list['doctor_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='worker_id' id='worker_id'>";
                      echo "<option value=''>Select Worker</option>";
                      foreach ($petugas as $list2) {
                        echo "<option value='". $list2['worker_id'] . "'>" . $list2['name'] . "</option>";
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
