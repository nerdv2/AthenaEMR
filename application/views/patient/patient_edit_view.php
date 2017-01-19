
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
          Patient Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $query->patient_id; ?>" class="form-control" placeholder="PatientID" name="patient_id" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" value="<?= $query->name; ?>" class="form-control" placeholder="Full Name" name="name" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" value="<?= $query->dob; ?>" placeholder="Date of Birth" name="dob" required>
                </div>
                <div class="col-md-12">
                     <select class="select2" name="gender">
                     <?php
                        if($query->gender=="male"){
                           echo "<option value='male' selected>Male</option>";
                           echo "<option value='female'>Female</option>"; 
                        } else if($query->gender=="female"){
                           echo "<option value='male'>Male</option>";
                           echo "<option value='female' selected>Female</option>"; 
                        } else {
                            echo "<option value='male'>Male</option>";
                            echo "<option value='female'>Female</option>";
                        }
                     ?>
                     </select>
                </div>
                <div class="col-md-12">
                     <textarea name="address" class="form-control"><?= $query->address; ?></textarea>
                </div>
                <div class="col-md-12">
                     <input type="number" value="<?= $query->phone; ?>" class="form-control" placeholder="Phone Number" name="phone">
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
