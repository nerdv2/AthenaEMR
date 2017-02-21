
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
    <?php $result = $this->PaymentModel->getResultID(); ?>
    <?php $worker = $this->PaymentModel->getWorkerID($_SESSION['worker_id']); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Payment Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value="<?= $data; ?>" class="form-control" placeholder="PaymentID" name="payment_id" readonly required>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='result_id' id='result_id'>";
                      echo "<option value=''>Select Lab Result</option>";
                      foreach ($result as $list) {
                        echo "<option value='". $list['result_id'] . "'>" . $list['result_id'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' name='worker_id' id='worker_id'>";
                      //echo "<option value=''>Select Worker</option>";
                      foreach ($worker as $list) {
                        echo "<option value='". $list['worker_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <input type="text" value="lab" class="form-control" placeholder="Type of Payment" name="type" readonly required>
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
