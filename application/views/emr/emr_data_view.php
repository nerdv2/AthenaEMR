<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <div class="app-title">
            <div class="title"><span class="highlight"><?= $query->record_id; ?> / <?= $query->doctor_name; ?> / <?= $query->patient_name; ?></span></div>
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
            <li role="tab2">
              <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Detail</a>
            </li>
            <li role="tab3">
              <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Vital</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Record Data</div>
                  <div class="section-body">
                    <div class="form-group">
                      <div class="col-md-3">
                        Record ID :
                      </div>
                      <div class="col-md-9">
                        <?= $query->record_id; ?>
                      </div>
                      <div class="col-md-3">
                        Doctor ID :
                      </div>
                      <div class="col-md-9">
                        <?= $query->doctor_id; ?>
                      </div>
                      <div class="col-md-3">
                        Doctor Name :
                      </div>
                      <div class="col-md-9">
                        <?= $query->doctor_name; ?>
                      </div>
                      <div class="col-md-3">
                        Register ID :
                      </div>
                      <div class="col-md-9">
                        <?= $query->register_id; ?>
                      </div>
                      <div class="col-md-3">
                        Patient Name :
                      </div>
                      <div class="col-md-9">
                        <?= $query->patient_name; ?>
                      </div>
                      <div class="col-md-3">
                        Time of Admission :
                      </div>
                      <div class="col-md-9">
                        <?= $query->time; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="tab2">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Record Detail</div>
                  <div class="section-body">
                    <div class="form-group">
                      <div class="col-md-3">
                        Complaints :
                      </div>
                      <div class="col-md-9">
                        <?= $query->complaint; ?>
                      </div>
                      <div class="col-md-3">
                        Symptoms :
                      </div>
                      <div class="col-md-9">
                        <?= $query->symptoms; ?>
                      </div>
                      <div class="col-md-3">
                        Diagnosis :
                      </div>
                      <div class="col-md-9">
                        <?= $query->diagnosis; ?>
                      </div>
                      <div class="col-md-3">
                        Handling :
                      </div>
                      <div class="col-md-9">
                        <?= $query->handling; ?>
                      </div>
                      <div class="col-md-3">
                        Additional Notes :
                      </div>
                      <div class="col-md-9">
                        <?= $query->additional_notes; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="tab3">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Record Vital</div>
                  <div class="section-body">
                    <div class="form-group">
                      <div class="col-md-3">
                        Weight :
                      </div>
                      <div class="col-md-9">
                        <?= $query->weight; ?> kg
                      </div>
                      <div class="col-md-3">
                        Height :
                      </div>
                      <div class="col-md-9">
                        <?= $query->height; ?> cm
                      </div>
                      <div class="col-md-3">
                        Blood Pressure Systolic :
                      </div>
                      <div class="col-md-9">
                        <?= $query->blood_pressure_systolic; ?> mmHg
                      </div>
                      <div class="col-md-3">
                        Blood Pressure Diastolic :
                      </div>
                      <div class="col-md-9">
                        <?= $query->blood_pressure_diastolic; ?> mmHg
                      </div>
                      <div class="col-md-3">
                        Pulse :
                      </div>
                      <div class="col-md-9">
                        <?= $query->pulse; ?> per min
                      </div>
                      <div class="col-md-3">
                        Respiration :
                      </div>
                      <div class="col-md-9">
                        <?= $query->respiration; ?> per min
                      </div>
                      <div class="col-md-3">
                        Temperature :
                      </div>
                      <div class="col-md-9">
                        <?= $query->temperature; ?> C
                      </div>
                      <div class="col-md-3">
                        Temperature Location :
                      </div>
                      <div class="col-md-9">
                        <?php
                          switch ($query->temperature_location) {
                            case 0:
                              echo "Unspecified";
                              break;
                            case 1:
                              echo "Rectal Temperature";
                              break;
                            case 2:
                              echo "Oral Temperature";
                              break;
                            case 3:
                              echo "Axillary Temperature";
                              break;
                            case 4:
                              echo "Tympanic Temperature";
                              break;
                            case 5:
                              echo "Vaginal Temperature";
                              break;
                            case 6:
                              echo "Bladder";
                              break;
                            case 7:
                              echo "Temporal Artery";
                              break;
                          }
                        ?>
                      </div>
                      <div class="col-md-3">
                        Oxygen Saturation :
                      </div>
                      <div class="col-md-9">
                        <?= $query->oxygen_saturation; ?> %
                      </div>
                      <div class="col-md-3">
                        Head Circumference :
                      </div>
                      <div class="col-md-9">
                        <?= $query->head_circumference; ?> cm
                      </div>
                      <div class="col-md-3">
                        Waist Circumference :
                      </div>
                      <div class="col-md-9">
                        <?= $query->waist_circumference; ?> cm
                      </div>
                      <div class="col-md-3">
                        BMI :
                      </div>
                      <div class="col-md-9">
                        <?= $query->bmi; ?> kg/m^2
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>