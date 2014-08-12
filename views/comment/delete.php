<?php $comment = $model['comment']; ?>

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Delete Comment</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <p>Are you sure you want to delete the Comment <?php echo $comment->id; ?>?</p>
          <p>About: <?php echo $comment->body; ?></p>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Delete Comment</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  