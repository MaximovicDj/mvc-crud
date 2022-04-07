<?php $this->view('inc/header') ?>

  <div class="container my-5">

    <p class="display-2"><?php echo $data['post']->title ?></p>

    <div class="row">

      <div class="col-md-12 col-lg-6 my-4 my-lg-2">
        <img src="<?php echo URLROOT ?>/img/<?php echo $data['post']->image ?>" style='width: 700px;' class="img-fluid mb-2" alt="">
      </div>

      <div class="col-md-12 col-lg-6 my-auto">
        <p class="lead text-my-center"><?php echo $data['post']->text ?></p>

      <?php if(isset($_SESSION['user_id'])): ?>

        <div class="row mt-4 mb-4">

          <div class="col">
            <a href="<?php echo URLROOT ?>/posts/edit/<?php echo $data['post']->id ?>" class="btn btn-primary w-100"><i class="fas fa-pencil-alt"> </i> Edit Text Post</a>
          </div>

          <div class="col">
            <a href="<?php echo URLROOT ?>/posts/editimage/<?php echo $data['post']->id ?>" class="btn btn-primary w-100"><i class="fas fa-pencil-alt"> </i> Change Image</a>
          </div>

          <div class="col">
            <form action="<?php echo URLROOT ?>/posts/delete/<?php echo $data['post']->id ?>" method="post">
              <input type="submit" name="deleteBtn" class="btn btn-danger w-100" value="Delete Post">
            </form>
          </div>

        </div>

    <?php endif; ?>

      </div>

    </div>

    <div class="d-flex justify-content-between w-50">

      <div class="">
        <span>Written By: <i><?php echo $data['post']->first_name. " " .$data['post']->last_name  ?></i></span><br>
        <span> <i><?php echo $data['post']->email ?></i></span>
      </div>

      <div class="">
        <span>Created At: <i><?php echo $data['post']->time ?></i></span><br>
      </div>

    </div>

  </div>

<?php $this->view('inc/footer') ?>
