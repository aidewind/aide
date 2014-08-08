<?php
$settings = $this->get_settings();
$tickets = $model['tickets'];
$sectors = $model['sectors'];

$prevUrl = NULL;
$nextUrl = NULL;
if(isset($this->sector)) {
  $prevUrl = $this->route_url(NULL, 'sector', array($this->sector, $this->page + 1));
  $nextUrl = $this->route_url(NULL, 'sector', array($this->sector, $this->page - 1));
}
else {
  $prevUrl = $this->route_url(NULL, 'home', $this->page + 1);
  $nextUrl = $this->route_url(NULL, 'home', $this->page - 1);
}
?>

<div class="container" id="main">
  <div class="row">
    <?php foreach($tickets as $ticket) { ?>
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">        
          <a href="#" class="pull-left"><?php echo $settings->display_name; ?></a>         
          <a href="#" class="pull-right"><?php echo $this->get_age_string($ticket->created); ?></a>
        </div>      
        <div class="panel-body">

          <a href="<?php echo $this->route_url(NULL, 'ticket', $ticket->id);?>" class="blacklink">
            <?php echo $ticket->body; ?>
          </a>
          <br>

          <div class="progress"><div class="progress-bar progress-bar-success" style="width: <?php echo rand(1,100);?>%"></div></div>

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

          <div align="center"><span class="label label-info"><?php date_default_timezone_set('UTC'); $date = new DateTime($ticket->created); echo $date->format('g:ia \o\n l jS F Y'); ?></span></div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <!--
  <div class="row">
  <br>
  <div class="clearfix"></div>
  <hr>
  <div class="col-md-12 text-center">
  <?php if (count($tickets) == 25) { ?>
  <a href="<?php echo $prevUrl; ?>">Older Posts</a>
  <?php } if($this->page > 0) { ?>
  <a href="<?php echo $nextUrl; ?>">Newer Posts</a>
  <?php } ?>
  </div>
  <hr>
  <div class="col-md-12 text-center">
  <?php foreach ($sectors as $sector) { ?>
  <a href="<?php echo $this->route_url(NULL, 'sector', $sector); ?>"><?php echo $sector?></a>
  <?php } ?>
  </div>
  </div>
  -->
</div>