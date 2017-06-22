
<?php $data = $this->PatientModel->generate_id(); ?>

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
                    <span class="highlight">Add New Patient</span>
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
                    <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Contact</a>
                    </li>
                    <li role="tab3">
                    <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Detail</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <?= form_open('', 'class="form form-horizontal" id="forminput"'); ?>
                    <div role="tabpanel" class="tab-pane active" id="tab1">
                        <div class="section">
                            <div class="section-title">Patient Information</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Patient ID*</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?= $data; ?>" class="form-control" placeholder="PatientID" name="patient_id" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name*</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Example: John Smith" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date of Birth*</label>
                                    <div class="col-md-9">
                                        <div class='input-group date' id='datetimepicker'>
                                            <input type='text' class="form-control"  name="dob" placeholder="Example: 1999-12-31" required />
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
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Gender*</label>
                                    <div class="col-md-9">
                                        <select class="select2" style="width: 100%;" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab2">
                        <div class="section">
                            <div class="section-title">Patient Address</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Home Address*</label>
                                    <div class="col-md-9">
                                        <textarea name="address" class="form-control"></textarea><br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">City*</label>
                                    <div class="col-md-9">
                                        <input type='text' class="form-control"  name="city" placeholder="" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">State</label>
                                    <div class="col-md-9">
                                        <input type='text' class="form-control"  name="state" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country*</label>
                                    <div class="col-md-9">
                                        <?php
                                            $this->load->view('countries.php');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Postal Code</label>
                                    <div class="col-md-9">
                                        <input type='number' class="form-control"  name="postal_code" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <div class="section-title">Patient Contact</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mother's Name</label>
                                    <div class="col-md-9">
                                        <input type='text' class="form-control"  name="mother_name" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Emergency Contact</label>
                                    <div class="col-md-9">
                                        <input type='number' class="form-control"  name="emergency_contact" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Home Phone</label>
                                    <div class="col-md-9">
                                        <input type='number' class="form-control"  name="home_phone" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Work Phone</label>
                                    <div class="col-md-9">
                                        <input type='number' class="form-control"  name="work_phone" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile Phone</label>
                                    <div class="col-md-9">
                                        <input type='number' class="form-control"  name="mobile_phone" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type='text' class="form-control"  name="email" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab3">
                        <div class="section">
                            <div class="section-title">Patient Demographic</div>
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Marital Status</label>
                                    <div class="col-md-9">
                                        <select class="select2" style="width: 100%;" name="marital_status">
                                            <option value="0">Not disclosed</option>
                                            <option value="1">Single</option>
                                            <option value="2">Married/Civil Partner</option>
                                            <option value="3">Divorced/Person whose Civil Partnership has been dissolved</option>
                                            <option value="4">Widowed/Surviving Civil Partner</option>
                                            <option value="5">Separated</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Religion</label>
                                    <div class="col-md-9">
                                        <input type='text' class="form-control" value="Undisclosed"  name="religion" placeholder="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Language</label>
                                    <div class="col-md-9">
                                        <?php
                                            $this->load->view('languages');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Race</label>
                                    <div class="col-md-9">
                                        <select class="select2" style="width: 100%;" name="race">
                                            <option value="0">Not disclosed</option>
                                            <option value="1">American Indian or Alaska Native</option>
                                            <option value="2">Asian</option>
                                            <option value="3">Black or African American</option>
                                            <option value="4">Native Hawaiian or Other Pacific Islander</option>
                                            <option value="5">White</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Ethnicity</label>
                                    <div class="col-md-9">
                                        <select class="select2" style="width: 100%;" name="ethnicity">
                                            <option value="0">Not disclosed</option>
                                            <option value="1">Hispanic or Latino</option>
                                            <option value="2">Not Hispanic or Latino</option>
                                        </select>
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