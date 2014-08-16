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