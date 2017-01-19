<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <img class="profile-img" src="../assets/images/profile.png">
          <div class="app-title">
            <div class="title"><span class="highlight"><?= $query->record_id; ?></span></div>
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
              <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Record</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Record Data</div>
                  <div class="section-body __indent">
                  Record ID : <?= $query->record_id; ?><br>
                  Doctor ID : <?= $query->doctor_id; ?><br>
                  Register ID : <?= $query->register_id; ?><br>
                  Patient ID : <?= $query->patient_id; ?><br>
                  Time of Admission : <?= $query->time; ?><br>
                  </div>
                </div>
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-book" aria-hidden="true"></i> Record Info</div>
                  <div class="section-body __indent">
                  Lab ID : <?= $query->lab_id; ?><br>
                  Lab Result ID : <?= $query->result_id; ?><br>
                  Prescription ID : <?= $query->prescription_id; ?><br>
                  Complaints : <?= $query->complaint; ?><br>
                  Symptoms : <?= $query->symptoms; ?><br>
                  Diagnosis : <?= $query->diagnosis; ?><br>
                  Handling : <?= $query->handling; ?><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>