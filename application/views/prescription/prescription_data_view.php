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
              <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Prescription</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Prescription Data</div>
                  <div class="section-body __indent">
                  Prescription ID : <?= $query->prescription_id; ?><br>
                  Worker ID : <?= $query->worker_id; ?><br>
                  Time of Entry : <?= $query->time; ?><br>
                  Description : <?= $query->description; ?><br>
                  </div>
                </div>
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-book" aria-hidden="true"></i> Prescription Info</div>
                  <div class="section-body __indent">
                  Medicine ID : <?= $query->medicine_id; ?><br>
                  Dosage : <?= $query->dosage; ?><br>
                  Amount : <?= $query->amount; ?><br>
                  Total Amount : <?= $query->total; ?><br>
                  Usage Info : <?= $query->usage; ?><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>