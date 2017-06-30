
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
    <?php $data = $this->MedicineTypeModel->generate_id(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Medicine Type Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
               
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="MedicineTypeID" name="type_id" readonly required>
                </div>
               
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Medicine Type Name"  name="name" required>
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
