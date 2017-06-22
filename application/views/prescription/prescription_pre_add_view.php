
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
    <?php $data = $this->PrescriptionModel->generate_id(); ?>
    <?php $record = $this->PrescriptionModel->getRecordID(); ?>
    <?php $worker = $this->PrescriptionModel->getWorkerID($_SESSION['worker_id']); ?>
    <?php $medicine = $this->PrescriptionModel->getMedicineID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Prescription Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="PrescriptionID" name="prescription_id" required>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='record_id' id='record_id'>";
                      echo "<option value=''>Select Medical Record</option>";
                      foreach ($record as $list) {
                        echo "<option value='". $list['record_id'] . "'>" . $list['record_id'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='worker_id' id='worker_id'>";
                      //echo "<option value=''>Select Workers</option>";
                      foreach ($worker as $list) {
                        echo "<option value='". $list['worker_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <textarea name="description" class="form-control" id="textarea-gui" required>Info</textarea><br>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12">
                    Number of Medicine:
                     <select class='select2' name='medicine_total' id='medicine_total'>
                        <?php
                            for($x = 1; $x <=10; $x++){
                                echo "<option value='". $x . "'>" . $x . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                  <hr>
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
