<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $comment = $model['comment'];
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4 class="title"><?php echo $comment->id; ?></h4>
        <p class="info"><?php echo $this->get_age_string($comment->created), ' by ', $settings->display_name;?></p>
        <div class="markdown">
          <?php 
            echo $parsedown->text($comment->body); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>  