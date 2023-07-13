<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; SIGCIKEUSIK</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/fontawesome-5.15.1/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">

</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container pt-5" id="background">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <?php if(session()->getFlashdata('sukses')) : ?>
							<div class="alert alert-success w-100" role="alert">
								<?= session()->getFlashdata('sukses'); ?>
							</div>
						<?php endif; ?>
						<?php if(session()->getFlashdata('gagal')) : ?>
							<div class="alert alert-danger w-100" role="alert">
								<?= session()->getFlashdata('gagal'); ?>
							</div>
						<?php endif; ?>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form method="POST" action="<?= base_url() ?>/auth/login" class="needs-validation" novalidate="">
                  <?= csrf_field(); ?>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <!-- <div class="float-end">
                        <a href="/lupa-password" class="text-small">
                          Forgot Password?
                        </a>
                      </div> -->
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/assets/js/popper.min.js">
  </script>
  <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js">
  </script>
  <script src="<?= base_url() ?>/assets/js/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/moment.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/assets/js/custom.js"></script>
</body>
</html>
