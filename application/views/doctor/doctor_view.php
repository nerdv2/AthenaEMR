
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Doctor Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/doctor/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('DoctorID','ClinicID','Name','Gender','D.O.B','Created At','Updated At','Action');
                foreach($query as $row){
                    $edit = "<a href='".site_url()."/doctor/viewdata/".$row->doctor_id."' title='".$row->name."'>View</a>
                    <br>
                    <a href='".site_url()."/doctor/editdata/".$row->doctor_id."' title='".$row->name."'>Edit</a>
                    <br>
                    <a href='".site_url()."/doctor/deletedata/".$row->doctor_id."' title='".$row->name."' onclick='return confirmDelete();'>Delete</a>"; 
                    $this->table->add_row($row->doctor_id, $row->clinic_id, $row->name, $row->gender, $row->dob, $row->created_at, $row->updated_at,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
