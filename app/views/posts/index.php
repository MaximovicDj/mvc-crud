<?php $this->view('inc/header'); ?>

  <div class="container my-5">

    <div class="row">

      <div class="col-8 col-md-8 col-lg-10">
        <p class="display-3">My Posts</p>
      </div>

      <div class="col-4 col-md-4 col-lg-2">
        <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-primary btn-lg mt-4"><i class="fas fa-pencil-alt"> </i> Add Post</a>
      </div>

      <?php flash("post_message") ?>

    </div>

    <hr class="my-5">

    <div class="row">

    <?php if(count($data['posts']) < 1) echo "No posts yet..." ?>

    <?php foreach($data['posts'] as $post): ?>

      <div class="col-md-12 col-lg-4 my-2">
        <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->id ?>"><img style="height: 300px; width: 480px;" class="img-fluid rounded" src="<?php echo URLROOT ?>/img/<?php echo $post->image ?>"></a>
      </div>

    <?php endforeach ?>

    </div>

  </div>

<?php $this->view('inc/footer'); ?>
