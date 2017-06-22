
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Lab Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/clinic/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('Clinic ID','Name','Tariff','Created At','Updated At','');
                foreach($query as $row){
                    $edit = "
                    <a href='".site_url()."/clinic/editdata/".$row->clinic_id."' title='".$row->name."'>Edit</a>
                    <br>
                    <a href='".site_url()."/clinic/deletedata/".$row->clinic_id."' title='".$row->name."' onclick='return confirmDelete();'>Delete</a>"; 
                    $this->table->add_row($row->clinic_id, $row->name, $row->tariff, $row->created_at, $row->updated_at,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
