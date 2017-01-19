
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
    <?php $data = $this->MedicineModel->generate_id(); ?>
    <?php $medicinetype = $this->MedicineModel->getMedicineTypeID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Medicine Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="MedicineID" name="medicine_id" required>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='type_id' id='type_id'>";
                      echo "<option value=''>Select Medicine Type</option>";
                      foreach ($medicinetype as $list) {
                        echo "<option value='". $list['type_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
               
                <div class="col-md-12">
                     <input type="text" class="form-control" placeholder="Medicine Name"  name="name" required>
                </div>
                <div class="col-md-12">
                     <textarea name="description" class="form-control">Description</textarea><br>
                </div>
                <div class="col-md-12">
                     <input type="number" class="form-control" placeholder="Price"  name="price">
                </div>
                 <div class="col-md-12">
                     <input type="number" class="form-control" placeholder="Unit" name="amount">
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
