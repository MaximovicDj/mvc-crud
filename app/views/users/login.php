<?php $this->view('inc/header') ?>

  <div class="col-md-5 mx-auto border bg-light p-5 my-5">

    <p class="display-3 my-4">Login</p>

    <?php flash("user_message"); ?>

    <form action="<?php echo URLROOT ?>/users/login" method="post">

      <div class="form-group">
        <label class="form-label mb-1">Email: *</label>
        <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['email'] ?>">
        <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
      </div>

      <div class="form-group my-3">
        <label class="form-label mb-1">Password: *</label>
        <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['password'] ?>">
        <span class="invalid-feedback"><?php echo $data['password_err'] ?></span>
      </div>

      <div class="row">

        <div class="col">
          <input type="submit" name="loginBtn" id="loginBtn" class="btn btn-dark w-100" value="Login">
        </div>
        <div class="col">
          <a href="<?php echo URLROOT ?>/users/register" class="btn btn-light border w-100">No an Accout? Register!</a>
        </div>

      </div>

    </form>

  </div>

<?php $this->view('inc/footer') ?>
