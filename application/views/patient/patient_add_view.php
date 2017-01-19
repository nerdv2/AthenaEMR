
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
    <?php $data = $this->PatientModel->generate_id(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Patient Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="PatientID" name="patient_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Full Name" name="name" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Date of Birth (e.g 1992-11-13)" name="dob" required>
                </div>
                <div class="col-md-12">
                     <select class="select2" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                </div>
                <div class="col-md-12">
                     <textarea name="address" class="form-control">Home Address</textarea>
                </div>
                <div class="col-md-12">
                     <input type="number" class="form-control" placeholder="Phone Number" name="phone">
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
