<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $comment = $model['comment'];
  $sectors = $model['sectors'];
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

        <ul class="list-group">
          <li class="list-group-item">
            <?php foreach ($sectors as $sector) { ?>
            <a href="<?php echo $this->route_url(NULL, 'sector', $sector); ?>"><span class="label label-warning"><?php echo $sector?></span></a>
            <?php } ?>          
          </li>
          <li class="list-group-item">
            <?php for ($i=0; $i < 1; $i++) { ?>
            <img src="<?php echo $comment->image_url;?>" width="30px" height="30px">
            <img src="https://trello-avatars.s3.amazonaws.com/7548032adad79c3b6a79399a54538e70/30.png" width="30px" height="30px">            
            <img src="https://trello-avatars.s3.amazonaws.com/fa239ce6f62fe75578c65c51123c22b4/30.png" width="30px" height="30px">            
            <img src="https://trello-avatars.s3.amazonaws.com/8d80f15f4b31c64e7c7d13d4d01e3af2/30.png" width="30px" height="30px">            
            <?php } ?>            
          </li>
        </ul> 

      </div>
    </div>
  </div>
</div>  