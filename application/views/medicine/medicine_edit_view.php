
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
          Medicine Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="MedicineID" name="medicine_id" value="<?= $query->medicine_id; ?>" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="MedicineTypeID" name="type_id" value="<?= $query->type_id; ?>" required>
                </div>
               
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Medicine Name" value="<?= $query->name; ?>" name="name" required>
                </div>
                <div class="col-md-12">
                     <textarea name="description" class="form-control"><?= $query->description; ?></textarea>
                </div>
                <div class="col-md-12">
                     <input type="number" class="form-control" placeholder="Price" value="<?= $query->price; ?>" name="price">
                </div>
                 <div class="col-md-12">
                     <input type="number" class="form-control" placeholder="Unit" value="<?= $query->amount; ?>" name="amount">
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
