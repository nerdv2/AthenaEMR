<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <img class="profile-img" src="../assets/images/profile.png">
          <div class="app-title">
            <div class="title"><span class="highlight"><?= $query->name; ?></span></div>
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
              <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Profile</a>
            </li>
            <li role="tab2">
              <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Records</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Patient Data</div>
                  <div class="section-body __indent">
                  Patient ID : <?= $query->patient_id; ?><br>
                  Created at : <?= $query->created_at; ?><br>
                  Updated at : <?= $query->updated_at; ?><br>
                  </div>
                </div>
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-book" aria-hidden="true"></i> Patient Bio</div>
                  <div class="section-body __indent">
                  Name : <?= $query->name; ?><br>
                  Date of Birth : <?= $query->dob; ?><br>
                  Gender : 
                  <?php
                    if($query->gender=="male"){
                        echo "Male";
                    } else if($query->gender=="female"){
                        echo "Female";
                    } else {
                        echo "";
                    }
                ?><br>
                  Address : <?= $query->address; ?><br>
                  Phone : <?= $query->phone; ?><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="tab2">
              <?php
                $template = array('table_open' => '<table class="table card-table" cellspacing="0" width="100%">');
                $this->table->set_template($template);

                $this->table->set_heading('Time','Complaint','');
                foreach($emr as $row){
                    $edit = "<a href='".site_url()."/emr/viewdata/".$row->record_id."' title='".$row->register_id."'>View</a>";
                    $this->table->add_row($row->time, $row->complaint, $edit);
                }
                echo $this->table->generate();
        ?>
          </div>
        </div>
      </div>
    </div>
  </div>