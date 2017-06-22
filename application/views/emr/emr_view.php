
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Medical Records Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/emr/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('RecordID','DoctorID','RegisterID','Time of Admission','');
                foreach($query as $row){
                  if($_SESSION['status'] == "ADMIN"){
                     $edit = "<a href='".site_url()."/emr/viewdata/".$row->record_id."' title='".$row->register_id."'>View</a>"; 
                  } else {
                    $edit = "<a href='".site_url()."/emr/viewdata/".$row->record_id."' title='".$row->register_id."'>View</a>"; 
                  }
                   
                    $this->table->add_row($row->record_id, $row->doctor_id, $row->register_id, $row->time ,$edit);
                }
                echo $this->table->generate();
          ?>
        </div>
      </div>
    </div>
  </div>
