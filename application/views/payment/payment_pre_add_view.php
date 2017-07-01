
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
    <?php $data = $this->PaymentModel->generate_id(); ?>
    <?php $register = $this->PaymentModel->getRegisterID(); ?>
    <?php $worker = $this->PaymentModel->getWorkerID($_SESSION['worker_id']); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Payment Type
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <select class="select2" style='width: 100%;' name="type">
                         <option value="clinic">CLINIC</option>
                         <option value="lab">LAB</option>
                         <option value="medicine">MEDICINE</option>
                     </select>
                </div>
                <!--
                <div class="col-md-12">
                     <input type="number" class="form-control" placeholder="Amount" name="amount" required>
                </div>
                -->
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
