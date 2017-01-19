<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body app-heading">
          <img class="profile-img" src="../assets/images/profile.png">
          <div class="app-title">
            <div class="title"><span class="highlight"><?= $query->name; ?></span></div>
            <div class="description">
                <?php
                    if($query->role=="lab"){
                        echo "Laboratorium Management";
                    } else if($query->role=="pharmacist"){
                        echo "Pharmacist Management";
                    } else if($query->role=="registration"){
                        echo "Registration Management";
                    } else if($query->role=="payment"){
                        echo "Payment Management";
                    } else {
                        echo "";
                    }
                ?>
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
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Worker Data</div>
                  <div class="section-body __indent">
                  Worker ID : <?= $query->worker_id; ?><br>
                  Created at : <?= $query->created_at; ?><br>
                  Updated at : <?= $query->updated_at; ?><br>
                  </div>
                </div>
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-book" aria-hidden="true"></i> Worker Bio</div>
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
                  Role : 
                  <?php
                    if($query->role=="lab"){
                        echo "Laboratorium Management";
                    } else if($query->role=="pharmacist"){
                        echo "Pharmacist Management";
                    } else if($query->role=="registration"){
                        echo "Registration Management";
                    } else if($query->role=="payment"){
                        echo "Payment Management";
                    } else {
                        echo "";
                    }
                  ?><br>
                  Address : <?= $query->address; ?><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>