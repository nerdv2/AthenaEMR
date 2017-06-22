
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Users Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/users/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('UserID','Username','Status','Doctor ID','Worker ID','Created Date','Updated Date','');
                foreach($query as $row){
                    $edit = "<a href='".site_url()."/users/editdata/".$row->id_user."' title='".$row->username."'>Edit</a>
                    <br>
                    <a href='".site_url()."/users/deletedata/".$row->id_user."' title='".$row->username."' onclick='return confirmDelete();'>Delete</a>"; 
                    $this->table->add_row($row->id_user, $row->username, $row->status, $row->doctor_id, $row->worker_id, $row->created_at, $row->updated_at,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
