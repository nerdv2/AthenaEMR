
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
          Workers Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="WorkersID" name="worker_id" value="<?= $query->worker_id; ?>" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Full Name" name="name" value="<?= $query->name; ?>" required>
                </div>
                <div class="col-md-12">
                     <select class="select2" name="gender">
                     <?php
                        if($query->gender=="male"){
                            echo "<option value='male' selected>Male</option>";
                            echo "<option value='female'>Female</option>";
                        } else if($query->gender=="female"){
                            echo "<option value='male'>Male</option>";
                            echo "<option value='female'selected>Female</option>";
                        } else {
                            echo "<option value='male'>Male</option>";
                            echo "<option value='female'>Female</option>";
                        }
                     ?>
                     </select>
                </div>
                <div class="col-md-12">
                     <select class="select2" name="role">
                     <?php
                        if($query->role=="lab"){
                            echo "<option value='lab' selected>Lab</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='registration'>Registration</option>";
                            echo "<option value='payment'>Payment</option>";
                        } else if($query->role=="pharmacist"){
                            echo "<option value='lab'>Lab</option>";
                            echo "<option value='pharmacist' selected>Pharmacist</option>";
                            echo "<option value='registration'>Registration</option>";
                            echo "<option value='payment'>Payment</option>";
                        } else if($query->role=="registration"){
                            echo "<option value='lab'>Lab</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='registration' selected>Registration</option>";
                            echo "<option value='payment'>Payment</option>";
                        } else if($query->role=="payment"){
                            echo "<option value='lab'>Lab</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='registration'>Registration</option>";
                            echo "<option value='payment' selected>Payment</option>";
                        } else {
                            echo "<option value='lab'>Lab</option>";
                            echo "<option value='pharmacist'>Pharmacist</option>";
                            echo "<option value='registration'>Registration</option>";
                            echo "<option value='payment'>Payment</option>";
                        }
                     ?>
                     </select>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Date of Birth" value="<?= $query->dob; ?>" name="dob" required>
                </div>
                <div class="col-md-12">
                     <textarea name="address" class="form-control"><?= $query->address; ?></textarea>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Photo filename" value="<?= $query->photo; ?>" name="photo">
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
