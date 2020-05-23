
  <div class="app app-default">

<div class="app-container app-login">
  <div class="flex-center">
    <div class="app-body">
      <div class="app-block">
      <div class="app-form">
      
        <div class="form-header">
          <div class="sidebar-brand"><span class="highlight">Athena</span> EMR<sup>alpha</sup></div>
        </div>
        <?php if (validation_errors()) : ?>
					<?= validation_errors() ?>
            <?php endif; ?>

            <?php if (isset($error)) : ?>
              <?= $error ?>
        <?php endif; ?>
        <?= form_open(); ?>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-success btn-submit" value="Login">
            </div>
        <?= form_close(); ?>

      </div>
      </div>
    </div>
  </div>
</div>

  </div>
</body>
</html>