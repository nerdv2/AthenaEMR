
<div class="row">
  <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          Payment Data
        </div>
        <div class="card-body no-padding">
          <?php
                $template = array('table_open' => '<table class="datatable table table-striped primary" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $cell_add = array('data' => '<a href="'.site_url().'/payment/adddata">Add New Data</a>', 'class' => 'highlight', 'colspan' => 2);

                $this->table->set_heading('PaymentID','RegisterID','WorkerID','Type of Payment','Amount','Time of Payment','');
                foreach($query as $row){
                    $edit = "<a href='".site_url()."/athenaReport/get_invoice/".$row->payment_id."' title='".$row->payment_id."'>Print</a><br>
                    <a href='".site_url()."/payment/deletedata/".$row->payment_id."' title='".$row->register_id."' onclick='return confirmDelete();'>Delete</a>"; 
                    $this->table->add_row($row->payment_id, $row->register_id, $row->worker_id, $row->type, $row->amount, $row->time,$edit);
                }
                echo $this->table->generate();
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
