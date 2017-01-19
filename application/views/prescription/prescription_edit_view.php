
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
          Prescription Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" class="form-control" value="<?= $query->prescription_id; ?>" placeholder="PrescriptionID" name="prescription_id" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" value="<?= $query->register_id; ?>" placeholder="RegisterID" name="register_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" value="<?= $query->worker_id; ?>" placeholder="WorkerID" name="worker_id" required>
                </div>
                <div class="col-md-12">
                     <textarea name="description" class="form-control" required><?= $query->description; ?></textarea>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" value="<?= $query->medicine_id; ?>" placeholder="MedicineID" name="medicine_id" required>
                </div>
                <div class="col-md-12">
                     <input type="text" class="form-control" value="<?= $query->dosage; ?>" placeholder="Dosage" name="dosage" required>
                </div>
                <div class="col-md-12">
                     <input type="number" class="form-control" value="<?= $query->amount; ?>" placeholder="Amount" name="amount" required>
                </div>
                <div class="col-md-12">
                     <input type="number" class="form-control" value="<?= $query->total; ?>" placeholder="Total Amount" name="total" required>
                </div>
                <div class="col-md-12">
                     <textarea name="usage" class="form-control" required>Usage Info</textarea>
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
