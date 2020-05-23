
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Patient Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/patient/add">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('PatientID','Name','D.O.B','Gender','Created At','Updated At','Action');
                foreach($query as $row){
                  if($_SESSION['role'] == "admin"){
                      $edit = "<a href='".site_url()."/athenaReport/get_id/".$row->patient_id."' title='".$row->name."'>Get ID</a>
                      <br>
                      <a href='".site_url()."/patient/view/".$row->patient_id."' title='".$row->name."'>View</a>
                      <br>
                      <a href='".site_url()."/patient/edit/".$row->patient_id."' title='".$row->name."'>Edit</a>
                      <br>
                      <a href='".site_url()."/patient/delete/".$row->patient_id."' title='".$row->name."' onclick='return confirmDelete();'>Delete</a>"; 
                  } else {
                    $edit = "<a href='".site_url()."/athenaReport/get_id/".$row->patient_id."' title='".$row->name."'>Get ID</a>
                    <br>
                    <a href='".site_url()."/patient/view/".$row->patient_id."' title='".$row->name."'>View</a>"; 
                  }
                    
                    $this->table->add_row($row->patient_id, $row->name, $row->dob, $row->gender, $row->created_at, $row->updated_at,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
