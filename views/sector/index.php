<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $sector = $model['sector'];
  $sectors = $model['sectors'];
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4 class="title"><?php echo $sector->complete_name; ?></h4>
        <p class="info"><?php echo $sector->email;?></p>
        <div class="markdown">
          <?php 
            echo $parsedown->text($sector->id); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>  