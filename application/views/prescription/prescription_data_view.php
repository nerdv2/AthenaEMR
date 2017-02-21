<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <div class="app-title">
            <div class="title"><span class="highlight"><?= $query->prescription_id; ?></span></div>
            <div class="description">
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-tab">
        <div class="card-header">
          <ul class="nav nav-tabs">
            <li role="tab1" class="active">
              <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Info</a>
            </li>
            <li role="tab2">
              <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Medicine</a>
            </li>
            <li role="tab3">
              <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Usage</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Prescription Info</div>
                  <div class="section-body __indent">
                  Prescription ID : <?= $query->prescription_id; ?><br>
                  Worker ID : <?= $query->worker_id; ?><br>
                  Time of Entry : <?= $query->time; ?><br>
                  Description : <?= $query->description; ?><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="tab2">
            <?php
                $template = array('table_open' => '<table class="table card-table" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $this->table->set_heading('MedicineID','Name', 'Total');
                foreach($medicine as $row){
                    $this->table->add_row($row->medicine_id, $row->medicine_name, $row->total);
                }
                echo $this->table->generate();
              ?>
          </div>
          <div role="tabpanel" class="tab-pane" id="tab3">
            <?php
                $template = array('table_open' => '<table class="table card-table" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $this->table->set_heading('MedicineID','Usage');
                foreach($usage as $row){
                    $this->table->add_row($row->medicine_id, $row->usage);
                }
                echo $this->table->generate();
              ?>
          </div>
        </div>
      </div>
    </div>
  </div>