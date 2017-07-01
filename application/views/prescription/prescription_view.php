
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Prescription Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/prescription/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('PrescriptionID','RecordID','WorkerID','Time of Entry','Action');
                foreach($query as $row){
                  if($_SESSION['status'] == "ADMIN"){
                    $edit = "<a href='".site_url()."/prescription/viewdata/".$row->prescription_id."' title='".$row->record_id."'>View</a>
                    <br>
                    <a href='".site_url()."/prescription/deletedata/".$row->prescription_id."' title='".$row->record_id."' onclick='return confirmDelete();'>Delete</a>"; 
                  } else {
                    $edit = "<a href='".site_url()."/prescription/viewdata/".$row->prescription_id."' title='".$row->record_id."'>View</a>"; 
                  }
                    
                    $this->table->add_row($row->prescription_id, $row->record_id, $row->worker_id, $row->time, $edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
