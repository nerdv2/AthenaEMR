
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

                $cell_add = array('data' => '<a href="'.site_url().'/emr/add">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('RecordID','Doctor','Patient','Time of Admission','Action');
                foreach($query as $row){
                  if($_SESSION['role'] == "admin"){
                     $edit = "<a href='".site_url()."/emr/view/".$row->record_id."' title='".$row->register_id."'>View</a>"; 
                  } else {
                    $edit = "<a href='".site_url()."/emr/view/".$row->record_id."' title='".$row->register_id."'>View</a>"; 
                  }
                   
                    $this->table->add_row($row->record_id, $row->doctor_name, $row->patient_name, $row->time ,$edit);
                }
                echo $this->table->generate();
          ?>
        </div>
      </div>
    </div>
  </div>
