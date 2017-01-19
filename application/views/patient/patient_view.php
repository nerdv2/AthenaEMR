
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

                $cell_add = array('data' => '<a href="'.site_url().'/patient/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('PatientID','Name','D.O.B','Gender','Created At','Updated At','');
                foreach($query as $row){
                    $edit = "<a href='".site_url()."/athenaReport/get_id/".$row->patient_id."' title='".$row->name."'>Get ID</a>
                    <br>
                    <a href='".site_url()."/patient/viewdata/".$row->patient_id."' title='".$row->name."'>View</a>
                    <br>
                    <a href='".site_url()."/patient/editdata/".$row->patient_id."' title='".$row->name."'>Edit</a>
                    <br>
                    <a href='".site_url()."/patient/deletedata/".$row->patient_id."' title='".$row->name."' onclick='return confirmDelete();'>Delete</a>"; 
                    $this->table->add_row($row->patient_id, $row->name, $row->dob, $row->gender, $row->created_at, $row->updated_at,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
