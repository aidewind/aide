<?php
  $settings = $this->get_settings();
  $entries = $model['entries'];
  $tags = $model['tags'];

  $prevUrl = NULL;
  $nextUrl = NULL;
  if(isset($this->tag)) {
    $prevUrl = $this->route_url(NULL, 'tag', array($this->tag, $this->page + 1));
    $nextUrl = $this->route_url(NULL, 'tag', array($this->tag, $this->page - 1));
  }
  else {
    $prevUrl = $this->route_url(NULL, 'home', $this->page + 1);
    $nextUrl = $this->route_url(NULL, 'home', $this->page - 1);
  }
?>
<div class="row">
  <div class="col-md-12"><h2>Posts</h2></div>
  <div class="col-md-2 col-sm-6">
    <?php foreach($entries as $entry) { ?>
    <div class="well"> 
      <h3><a href="<?php echo $this->route_url(NULL, 'entry', $entry->id);?>"><?php echo $entry->title; ?></a></h3>
      <p class="info"><?php echo $this->get_age_string($entry->created), ' by ', $settings->display_name; ?></p>
      <p class="snippet"><?php echo $entry->snippet; ?></p>
    </div>
    <?php } ?>
  </div>
</div>


<div class="row">
  <br>
  <div class="clearfix"></div>
    <hr>
    <div class="col-md-12 text-center">
      <?php if (count($entries) == 25) { ?>
      <a href="<?php echo $prevUrl; ?>">Older Posts</a>
      <?php } if($this->page > 0) { ?>
      <a href="<?php echo $nextUrl; ?>">Newer Posts</a>
      <?php } ?>
    </div>
    <hr>
    <div class="col-md-12 text-center">
      <?php foreach ($tags as $tag) { ?>
      <a href="<?php echo $this->route_url(NULL, 'tag', $tag); ?>"><?php echo $tag?></a>
      <?php } ?>
    </div>
</div>
