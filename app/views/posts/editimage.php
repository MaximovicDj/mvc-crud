<?php $this->view('inc/header') ?>

  <div class="container my-5">

    <div class="col-md-10 mx-auto border bg-light p-5">

      <p class="display-3 my-2">Change image</p>

      <form action="<?php echo URLROOT ?>/posts/editimage/<?php echo $data['id'] ?>" method="post" enctype="multipart/form-data">

       <div class="form-group mb-3">
         <label class="form-label">Image: *</label>
         <input type="file" name="image" class="form-control <?php echo (!empty($data['image_err'])) ? 'is-invalid' : '' ?>" value="">
         <span class="invalid-feedback"><?php echo $data['image_err'] ?></span>
       </div>

      <input type="submit" name="changeImg" id="changeImg" class="btn btn-dark w-100" value="Change Image">

      </form>

    </div>

  </div>

<?php $this->view('inc/footer') ?>
