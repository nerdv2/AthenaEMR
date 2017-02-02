
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Registration Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/registration/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('RegisterID','WorkerID','PatientID','ClinicID','Time of Register','Entry Number','');
                foreach($query as $row){
                  if($_SESSION['status'] == "ADMIN"){
                    $edit = "
                    <a href='".site_url()."/registration/deletedata/".$row->register_id."' title='".$row->patient_id."' onclick='return confirmDelete();'>Delete</a>"; 
                  } else {
                    $edit = "";
                  }
                    $this->table->add_row($row->register_id, $row->worker_id, $row->patient_id, $row->clinic_id, $row->time, $row->entry_no,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
