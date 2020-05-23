
<body>
  <div class="app app-default">
  <aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header">
      <a class="sidebar-brand" href="#"><span class="highlight">Athena</span> EMR<sup>alpha</sup></a>
      <button type="button" class="sidebar-toggle">
        <i class="fa fa-times"></i>
      </button>
    </div>
    <div class="sidebar-menu">
      <ul class="sidebar-nav">
        <li>
          <a href="<?php echo base_url('index.php/athenaMain/'); ?>">
            <div class="icon">
              <i class="fa fa-tasks" aria-hidden="true"></i>
            </div>
            <div class="title">Dashboard</div>
          </a>
        </li>
        <?php
          if($_SESSION['status'] == "ADMIN"){
        ?>
        <li class="active dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon">
              <i class="fa fa-group" aria-hidden="true"></i>
            </div>
            <div class="title">Users</div>
          </a>
          <div class="dropdown-menu">
            <ul>
              <li class="section"><i class="fa fa-user" aria-hidden="true"></i> Workers Management</li>
              <li><a href="<?php echo base_url('index.php/workers'); ?>">Workers Data</a></li>
              <li><a href="<?php echo base_url("index.php/workers/add"); ?>">Add New Workers</a></li>
              <li class="line"></li>
              <li class="section"><i class="fa fa-user" aria-hidden="true"></i> Doctors Management</li>
              <li><a href="<?php echo base_url('index.php/doctor'); ?>">Doctors Data</a></li>
              <li><a href="<?php echo base_url("index.php/doctor/add"); ?>">Add New Doctors</a></li>
              <li class="line"></li>
              <li class="section"><i class="fa fa-user" aria-hidden="true"></i> Users Management</li>
              <li><a href="<?php echo base_url('index.php/users'); ?>">Users Data</a></li>
              <li><a href="<?php echo base_url('index.php/users/add'); ?>">Add New Users</a></li>
            </ul>
          </div>
        </li>
        <?php
          }
        ?>
        
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon">
              <i class="fa fa-book" aria-hidden="true"></i>
            </div>
            <div class="title">Management</div>
          </a>
          <div class="dropdown-menu">
            <ul>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "REGISTRATION"){
              ?>
              <li class="section"><i class="fa fa-group" aria-hidden="true"></i> Registration Management</li>
              <li><a href="<?php echo base_url('index.php/registration'); ?>">Registration Data</a></li>
              <?php
                  if($_SESSION['status'] == "ADMIN"){
              ?>
              <li><a href="<?php echo base_url('index.php/clinic'); ?>">Clinic Data</a></li>
              <?php
                  }
              ?>
              <li class="line"></li>
              <?php
                  }
              ?>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "PAYMENT"){
              ?>
              <li class="section"><i class="fa fa-usd" aria-hidden="true"></i> Payment Management</li>
              <li><a href="<?php echo base_url('index.php/payment'); ?>">Payment Data</a></li>
              <li class="line"></li>
              <?php
                  }
              ?>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "REGISTRATION" or $_SESSION['status'] == "DOCTOR"){
              ?>
              <li class="section"><i class="fa fa-stethoscope" aria-hidden="true"></i> Records Management</li>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "REGISTRATION" or $_SESSION['status'] == "DOCTOR"){
              ?>
              <li><a href="<?php echo base_url('index.php/patient'); ?>">Patient Data</a></li>
              <?php
                  }
              ?>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "DOCTOR"){
              ?>
              <li><a href="<?php echo base_url('index.php/emr'); ?>">Medical Records Data</a></li>
              <?php
                  }
              ?>
              <li class="line"></li>
              <?php
                  }
              ?>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "LAB"){
              ?>
              <li class="section"><i class="fa fa-heartbeat" aria-hidden="true"></i> Lab Management</li>
              <?php
                  if($_SESSION['status'] == "ADMIN"){
              ?>
              <li><a href="<?php echo base_url('index.php/lab'); ?>">Lab Data</a></li>
              <?php
                  }
              ?>
              <li><a href="<?php echo base_url('index.php/labresult'); ?>">Lab Result Data</a></li>
              <li class="line"></li>
              <?php
                  }
              ?>
              <?php
                  if($_SESSION['status'] == "ADMIN" or $_SESSION['status'] == "PHARMACIST"){
              ?>
              <li class="section"><i class="fa fa-medkit" aria-hidden="true"></i> Pharmacist Management</li>
              <li><a href="<?php echo base_url('index.php/prescription'); ?>">Prescription Data</a></li>
              <li><a href="<?php echo base_url('index.php/medicine'); ?>">Medicine Data</a></li>
              <li><a href="<?php echo base_url('index.php/medicine_type'); ?>">Medicine Type Data</a></li>
              <?php
                  }
              ?>
            </ul>
          </div>
        </li>
        <?php
          if($_SESSION['status'] == "ADMIN"){
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon">
              <i class="fa fa-file-o" aria-hidden="true"></i>
            </div>
            <div class="title">Reports</div>
          </a>
          <div class="dropdown-menu">
            <ul>
              <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Medical Reports</li>
              <li><a href="<?php echo base_url('index.php/athenaReport/registration_view'); ?>">Registration Data Per Month</a></li>
              <li><a href="<?php echo base_url('index.php/athenaReport/visit_view'); ?>">Patient Record Per Month</a></li>
              <li><a href="<?php echo base_url('index.php/athenaReport/medical_report_view'); ?>">Patient Medical Record Data</a></li>
              <li><a href="<?php echo base_url('index.php/athenaReport/export_patientdata'); ?>">Complete Patient Data</a></li>
              <li class="line"></li>
              <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Management Reports</li>
              <li><a href="<?php echo base_url('index.php/athenaReport/export_userdata'); ?>">Complete User Data</a></li>
              <li><a href="<?php echo base_url('index.php/athenaReport/export_doctordata'); ?>">Complete Doctor Data</a></li>
              <li><a href="<?php echo base_url('index.php/athenaReport/export_workerdata'); ?>">Complete Worker Data</a></li>
              <li><a href="<?php echo base_url('index.php/athenaReport/export_medicinedata'); ?>">Complete Medicine Data</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <ul class="menu">
        <li>
          <a href="/" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cogs" aria-hidden="true"></i>
          </a>
        </li>
        <li><a href="#"><span class="flag-icon flag-icon-us flag-icon-squared"></span></a></li>
      </ul>
    </div>
    <?php
          }
    ?>
    
  </aside>
