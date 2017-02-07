
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
          Users Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                  <input type="hidden" class="form-control" placeholder="id" name="id_user" value="<?= $query->id_user; ?>" readonly>
                     <input type="text" class="form-control" placeholder="Username" value="<?= $query->username; ?>" name="username" required>
                </div>
                <div class="col-md-12">
                     <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="col-md-12">
                     <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm" required>
                </div>
                <div class="col-md-12">
                     <select class="select2" name="status">
                       <?php
                          if($query->status=="admin"){
                            echo "<option value='admin' selected>Administrator</option>";
                            echo "<option value='doctor'>Doctor</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='payment'>Payment Administration</option>";
                            echo "<option value='registration'>Registration Administration</option>";
                            echo "<option value='lab'>Lab Administration</option>";
                          } else if($query->status=="doctor"){
                            echo "<option value='admin'>Administrator</option>";
                            echo "<option value='doctor' selected>Doctor</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='payment'>Payment Administration</option>";
                            echo "<option value='registration'>Registration Administration</option>";
                            echo "<option value='lab'>Lab Administration</option>";
                          } else if($query->status=="pharmacist"){
                            echo "<option value='admin'>Administrator</option>";
                            echo "<option value='doctor'>Doctor</option>";
                            echo "<option value='pharmacist' selected>Pharmacist</option>";
                            echo "<option value='payment'>Payment Administration</option>";
                            echo "<option value='registration'>Registration Administration</option>";
                            echo "<option value='lab'>Lab Administration</option>";
                          } else if($query->status=="payment"){
                            echo "<option value='admin'>Administrator</option>";
                            echo "<option value='doctor'>Doctor</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='payment' selected>Payment Administration</option>";
                            echo "<option value='registration'>Registration Administration</option>";
                            echo "<option value='lab'>Lab Administration</option>";
                          } else if($query->status=="registration"){
                            echo "<option value='admin'>Administrator</option>";
                            echo "<option value='doctor'>Doctor</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='payment'>Payment Administration</option>";
                            echo "<option value='registration' selected>Registration Administration</option>";
                            echo "<option value='lab'>Lab Administration</option>";
                          } else if($query->status=="lab"){
                            echo "<option value='admin'>Administrator</option>";
                            echo "<option value='doctor'>Doctor</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='payment'>Payment Administration</option>";
                            echo "<option value='registration'>Registration Administration</option>";
                            echo "<option value='lab' selected>Lab Administration</option>";
                          } else {
                            echo "<option value='admin' selected>Administrator</option>";
                            echo "<option value='doctor'>Doctor</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='payment'>Payment Administration</option>";
                            echo "<option value='registration'>Registration Administration</option>";
                            echo "<option value='lab'>Lab Administration</option>";
                          }
                       ?>
                     </select>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Doctor ID" value="<?= $query->doctor_id; ?>" name="doctor_id">
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Workers ID" value="<?= $query->worker_id; ?>" name="worker_id">
                </div>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="photo" value="<?= $query->photo; ?>" placeholder="Photo filename">
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
