
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
          Doctor Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $id; ?>" class="form-control" placeholder="DoctorID" name="doctor_id" readonly required>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='clinic_id' style='width: 100%;' id='clinic_id'>";
                      echo "<option value=''>Select Clinic</option>";
                      foreach ($clinic as $list) {
                        echo "<option value='". $list['clinic_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Full Name" name="name" required>
                </div>
                <div class="col-md-12">
                     <select class="select2" style='width: 100%;' name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                     </select>
                </div>
                <div class="col-md-12">
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control"  name="dob" placeholder="Date of Birth" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                    <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker').datetimepicker({
                                    viewMode: 'years',
                                    format: 'YYYY-MM-DD'
                                });
                            });
                    </script>
                </div>
                <div class="col-md-12">
                     <textarea name="address" class="form-control">Home Address</textarea>
                </div>
                <div class="col-md-12">
                     <br><input type="number" class="form-control" placeholder="Phone Number" name="phone">
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
