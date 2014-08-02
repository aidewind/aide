<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $ticket = $model['ticket'];
  $tags = $model['tags'];
?>

<h1 class="title"><?php echo $ticket->title; ?></h1>
<p class="info"><?php echo $this->get_age_string($ticket->created), ' by ', $settings->display_name;?></p>
<div class="markdown">
  <?php 
    if(!empty($ticket->image_url)) {
      echo '<img src="', $ticket->image_url, '" alt="Title Image" />';
    }
    echo $parsedown->text($ticket->body); 
  ?>
</div>
<?php if(count($tags) > 0 ) { ?>
<div>
  <span style="font-weight:bold">Tags:</span>
  <?php foreach ($tags as $tag) { ?>
  <a href="<?php echo $this->route_url(NULL, 'tag', $tag); ?>"><?php echo $tag; ?></a>
  <?php } ?>
</div>
<?php } ?>