
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Lab Result Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/labresult/add">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('LabResultID','WorkerID','Time of Entry','Action');
                foreach($query as $row){
                  if($_SESSION['status'] == "ADMIN"){
                    $edit = "<a href='".site_url()."/athenaReport/get_labresult/".$row->result_id."' title='".$row->result_id."'>Print</a><br>
                    <a href='".site_url()."/labresult/view/".$row->result_id."' title='".$row->result_id."'>View</a>
                    <br>
                    <a href='".site_url()."/labresult/edit/".$row->result_id."' title='".$row->result_id."'>Edit</a>
                    <br>
                    <a href='".site_url()."/labresult/delete/".$row->result_id."' title='".$row->result_id."' onclick='return confirmDelete();'>Delete</a>"; 
                  } else {
                    $edit = "<a href='".site_url()."/athenaReport/get_labresult/".$row->result_id."' title='".$row->result_id."'>Print</a><br>
                    <a href='".site_url()."/labresult/view/".$row->result_id."' title='".$row->result_id."'>View</a>"; 
                  }
                    
                    $this->table->add_row($row->result_id, $row->worker_id, $row->time, $edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
