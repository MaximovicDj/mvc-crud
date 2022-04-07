<?php $this->view('inc/header') ?>

  <div class="container my-5">

    <div class="col-md-10 mx-auto border bg-light p-5">

      <p class="display-3 my-2">Add Post</p>

      <form action="<?php echo URLROOT ?>/posts/add" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label class="form-label mb-1">Title: *</label>
          <input type="text" name="title" id="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '' ?>" value="<?php echo $data['title'] ?>">
          <span class="invalid-feedback"><?php echo $data['title_err'] ?></span>
        </div>

        <div class="form-group my-3">
          <label class="form-label mb-1">Title: *</label>
          <textarea name="text" id="text" class="form-control <?php echo (!empty($data['text_err'])) ? 'is-invalid' : '' ?>" rows="8" cols="80"><?php echo $data['text'] ?></textarea>
          <span class="invalid-feedback"><?php echo $data['text_err'] ?></span>
       </div>

       <div class="form-group mb-3">
         <label class="form-label">Image: *</label>
         <input type="file" name="image" class="form-control <?php echo (!empty($data['image_err'])) ? 'is-invalid' : '' ?>" value="">
         <span class="invalid-feedback"><?php echo $data['image_err'] ?></span>
       </div>

      <input type="submit" name="addBtn" id="addBtn" class="btn btn-dark w-100" value="Add Post">

      </form>

    </div>

  </div>

<?php $this->view('inc/footer') ?>
