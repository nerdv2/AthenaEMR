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
              <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Medicine</a>
            </li>
          </ul>
        </div>
        <div class="card-body no-padding tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-user" aria-hidden="true"></i> Medicine Data</div>
                  <div class="section-body __indent">
                  Medicine ID : <?= $query->medicine_id; ?><br>
                  Medicine Type ID : <?= $query->type_id; ?><br>
                  Created at : <?= $query->created_at; ?><br>
                  Updated at : <?= $query->updated_at; ?><br>
                  </div>
                </div>
                <div class="section">
                  <div class="section-title"><i class="icon fa fa-book" aria-hidden="true"></i> Medicine Info</div>
                  <div class="section-body __indent">
                  Name : <?= $query->name; ?><br>
                  Description : <?= $query->description; ?><br>
                  Price : <?= $query->price; ?><br>
                  Amount : <?= $query->amount; ?><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>