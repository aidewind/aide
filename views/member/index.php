<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $member = $model['member'];
  $sectors = $model['sectors'];
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4 class="title"><?php echo $member->complete_name; ?></h4>
        <p class="info"><?php echo $member->email;?></p>
        <div class="markdown">
          <?php 
            echo $parsedown->text($member->id); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>  