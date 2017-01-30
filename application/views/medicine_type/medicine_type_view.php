
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Medicine Type Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/medicinetype/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('Medicine Type ID','Medicine Type Name','Created At','Updated At','');
                foreach($query as $row){
                  if($_SESSION['status'] == "ADMIN"){
                    $edit = "
                    <a href='".site_url()."/medicineType/editdata/".$row->type_id."' title='".$row->name."'>Edit</a>
                    <br>
                    <a href='".site_url()."/medicineType/deletedata/".$row->type_id."' title='".$row->name."' onclick='return confirmDelete();'>Delete</a>"; 
                  } else {
                    $edit = "";
                  }
                    
                    $this->table->add_row($row->type_id,$row->name, $row->created_at, $row->updated_at,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
