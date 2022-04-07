<?php $this->view('inc/header') ?>

<?php $this->view('inc/carousel') ?>

  <div class="container">

    <p class="my-5 display-1">All Posts</p>

    <div class="row my-5">

    <?php if(count($data['posts']) < 1) echo "No Posts yet.." ?>

    <?php foreach($data['posts'] as $post): ?>

      <div class="col-md-12 col-lg-4 my-2">
        <a href="<?php echo URLROOT ?>/posts/show/<?php echo $post->id ?>"><img style="height: 300px; width: 480px;" class="img-fluid rounded" src="<?php echo URLROOT ?>/img/<?php echo $post->image ?>"></a>
      </div>

    <?php endforeach ?>

    </div>

  </div>

<?php $this->view("inc/footer") ?>
