
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
    <?php $data = $this->LabResultModel->generate_id(); ?>
    <?php $worker = $this->LabResultModel->getWorkerID($_SESSION['worker_id']); ?>
    <?php $record = $this->LabResultModel->getRecordID(); ?>
    <?php $lab = $this->LabResultModel->getLabID(); ?>
  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Lab Result Data
        </div>
        <div class="card-body">
            <div class="row">
              <?= form_open() ?>
                <div class="col-md-12">
                     <input type="text" value=<?= $data; ?> class="form-control" placeholder="LabResultID" name="result_id" readonly>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' style='width: 100%;' name='worker_id' id='worker_id'>";
                      //echo "<option value=''>Select Workers</option>";
                      foreach ($worker as $list) {
                        echo "<option value='". $list['worker_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' style='width: 100%;' name='record_id' id='record_id'>";
                      echo "<option value=''>Select Medical Record</option>";
                      foreach ($record as $list) {
                        echo "<option value='". $list['record_id'] . "'>" . $list['record_id'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <?php
                      echo "<select class='select2' style='width: 100%;' name='lab_id' id='lab_id'>";
                      echo "<option value=''>Select Lab</option>";
                      foreach ($lab as $list) {
                        echo "<option value='". $list['lab_id'] . "'>" . $list['name'] . "</option>";
                      }
                    ?>
                    </select>
                </div>
                <div class="col-md-12">
                     <textarea name="result_data" class="form-control" id="textarea-tinymce">
                     <table style="width: 950px;">
                       <tbody>
                        <tr class="heading" style="height: 14px;">
                        <td style="width: 200px; height: 14px;">Test Name</td>
                        <td style="width: 200px; height: 14px;">Result</td>
                        <td style="width: 50px; height: 14px;">Flag</td>
                        <td style="width: 100px; height: 14px;">Unit</td>
                        <td style="width: 200px; height: 14px;">Ref. Value</td>
                        <td style="width: 200px; height: 14px;">Method</td>
                        </tr>
                        <tr style="height: 15px;">
                        <td style="width: 200px; height: 15px;"></td>
                        <td style="width: 200px; height: 15px;"></td>
                        <td style="width: 50px; height: 15px;"></td>
                        <td style="width: 100px; height: 15px;"></td>
                        <td style="width: 200px; height: 15px;"></td>
                        <td style="width: 200px; height: 15px;"></td>
                        </tr>
                      </tbody>
                    </table>
                     </textarea><br>
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
