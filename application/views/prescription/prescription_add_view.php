
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
    <?php $medicine = $this->PrescriptionModel->getMedicineID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Prescription Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open('prescription/process_add') ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $prescription_id; ?>" class="form-control" placeholder="PrescriptionID" name="prescription_id" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" value="<?= $record_id; ?>" class="form-control" placeholder="RecordID" name="record_id" readonly>
                </div>
                <div class="col-md-12">
                     <input type="text" value="<?= $worker_id; ?>" class="form-control" placeholder="WorkerID" name="worker_id" readonly>
                </div>
                <div class="col-md-12">
                     <textarea name="description" class="form-control" id="textarea-gui" readonly><?= $description; ?></textarea><br>
                </div>
                <?php
                    for($x = 0; $x < $medicine_total; $x++){
                        ?>

                        <div class="col-md-12">
                          <hr>
                          Medicine data #<?= $x; ?> :
                        </div>
                        <div class="col-md-12">
                            <?php
                              echo "<select class='select2' style='width: 100%;' name='medicine_id[". $x ."]' id='medicine_id'>";
                              echo "<option value=''>Select Medicine</option>";
                              foreach ($medicine as $list) {
                                echo "<option value='". $list['medicine_id'] . "'>" . $list['name'] . "</option>";
                              }
                            ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Dosage" name="dosage[<?= $x; ?>]" required>
                        </div>
                        <div class="col-md-12">
                            <input type="number" class="form-control" placeholder="Amount" name="amount[<?= $x; ?>]" required>
                        </div>
                        <div class="col-md-12">
                            <input type="number" class="form-control" placeholder="Total Amount" name="total[<?= $x; ?>]" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="usage[<?= $x; ?>]" class="form-control" id="textarea-gui" required>Usage Info</textarea><br>
                        </div>
                        <div class="col-md-12">
                          <hr>
                        </div>

                        <?php
                    }
                ?>
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
