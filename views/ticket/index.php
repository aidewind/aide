<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $ticket = $model['ticket'];
  $sectors = $model['sectors'];
?>

<div class="navbar navbar-default" id="subnav">
  <div class="col-md-12">
    <div class="navbar-header">
      <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> General Settings <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
      <ul class="nav dropdown-menu">
        <li><a href="<?php echo $this->route_url('password'); ?>"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Update Password</a></li>
        <li><a href="<?php echo $this->route_url('settings'); ?>"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
      </ul>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse2">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="<?php echo $this->route_url('index'); ?>">~admin</a></li>
        <?php 
          foreach ($sectors as $key => $value) {
            echo '<li><a href="#">~'.$value.'</a></li>';
          }
        ?>
      </ul>
    </div>  
  </div> 
</div>  

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4 class="title"><?php echo $ticket->id; ?></h4>
        <p class="info"><?php echo $this->get_age_string($ticket->created), ' by ', $settings->display_name;?></p>
        <div class="markdown">
          <?php 
            echo $parsedown->text($ticket->body); 
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
            <img src="<?php echo $ticket->image_url;?>" width="30px" height="30px">
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