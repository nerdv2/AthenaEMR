<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>AthenaEMR - Login</title>
  <link rel="stylesheet" href="<?php echo base_url("assets/css/login.css"); ?>">

  <script src="<?php echo base_url("assets/js/prefixfree.min.js"); ?>"></script>

</head>

<body>
  <div class="body">
	<?php if (validation_errors()) : ?>
					<?= validation_errors() ?>
		<?php endif; ?>

		<?php if (isset($error)) : ?>
					<?= $error ?>
		<?php endif; ?>
	</div>
		<div class="grad"></div>
		<div class="header">
			<div>Athena<span>EMR</span><sup>beta</sup></div>
		</div>
		<br>
		<?= form_open() ?>
		<div class="login">
				<input type="text" placeholder="username" name="username"><br>
				<input type="password" placeholder="password" name="password"><br>
				<input type="submit" value="Login">
		</div>
  <script src='<?php echo base_url("assets/js/jquery.min.js"); ?>'></script>

  
</body>
</html>
