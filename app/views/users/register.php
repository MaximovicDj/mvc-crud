<?php $this->view('inc/header') ?>

  <div class="col-md-5 mx-auto border bg-light p-5 my-5">

    <p class="display-3 my-4">Register</p>

    <form action="<?php echo URLROOT ?>/users/register" method="post">

      <div class="form-group">
        <label class="form-label mb-1">First Name: *</label>
        <input type="text" name="first_name" id="first_name" class="form-control <?php echo (!empty($data['first_name_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['first_name'] ?>">
        <span class="invalid-feedback"><?php echo $data['first_name_err'] ?></span>
      </div>

      <div class="form-group my-3">
        <label class="form-label mb-1">Last Name: *</label>
        <input type="text" name="last_name" id="last_name" class="form-control <?php echo (!empty($data['last_name_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['last_name'] ?>">
        <span class="invalid-feedback"><?php echo $data['last_name_err'] ?></span>
      </div>

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

      <div class="form-group mb-3">
        <label class="form-label mb-1">Confirm Password: *</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['confirm_password'] ?>">
        <span class="invalid-feedback"><?php echo $data['confirm_password_err'] ?></span>
      </div>

      <div class="row">

        <div class="col">
          <input type="submit" name="registerBtn" id="registerBtn" class="btn btn-dark w-100" value="Register">
        </div>
        <div class="col">
          <a href="<?php echo URLROOT ?>/users/login" class="btn btn-light border w-100">Have an Accout? Login!</a>
        </div>

      </div>

    </form>

  </div>

<?php $this->view('inc/footer') ?>
