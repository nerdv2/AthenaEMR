<?php $registertoday = $this->DashModel->getNewRegister(); ?>
<?php $patienttotal = $this->DashModel->getPatientTotal(); ?>
<?php $registrationtotal = $this->DashModel->getRegistrationTotal(); ?>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-yellow-light">
        <div class="card-body">
            <i class="icon fa fa-user-plus fa-4x"></i>
            <div class="content">
                <div class="title">New Registration</div>
                <div class="value"><span class="sign"></span><?= $registertoday; ?></div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-blue-light">
        <div class="card-body">
            <i class="icon fa fa-user fa-4x"></i>
            <div class="content">
                <div class="title">Patient Registered</div>
                <div class="value"><span class="sign"></span><?= $patienttotal; ?></div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-green-light">
        <div class="card-body">
            <i class="icon fa fa-users fa-4x"></i>
            <div class="content">
                <div class="title">Registration</div>
                <div class="value"><span class="sign"></span><?= $registrationtotal; ?></div>
            </div>
        </div>
      </a>
    </div>
</div>
