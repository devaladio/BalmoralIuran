<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>assets/index2.html"><b>Balmoral</b>Something</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login</p>
      <?= $this->session->flashdata('message'); ?>
      <form action="<?php echo base_url('index.php/auth/login'); ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="<?= set_value('username'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button class="btn btn-primary" href="<?= base_url('home.php/page'); ?>">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a class="primary" href="<?= base_url('index.php/auth/registration'); ?>">Register</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->