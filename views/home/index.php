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

  <?php
    global $keys;
    $keys = null;
    $fn = '/home/mfer/aide/trello-backup/trello-org-UFMG-FALE-board-4050.json';
    is_readable($fn) && $keys = json_decode(file_get_contents($fn));
    $k = get_object_vars($keys);
    //echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    //  print_r($k["cards"]);
    //echo "</pre>\n";

    //echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    foreach($k["cards"] as $card){
      $c = get_object_vars($card);
      
      //print_r($c["idShort"]." ".$c["shortLink"]);

      $fn = '/home/mfer/aide/trello-backup/card-'.$c["idShort"].'.json';
      
      is_readable($fn) && $actions = json_decode(file_get_contents($fn));
      
      if(!file_get_contents($fn)) {
        //echo "deu false";
      } else {
        //var_dump($actions);
        $a0 = get_object_vars($actions[0]);
        //var_dump($a0["data"]);
        $a0d = get_object_vars($a0["data"]);
        //var_dump($a0d["card"]);
        $a0dn = get_object_vars($a0d["card"]);
        //var_dump($a0dn["name"]);
    ?>

        <div class="col-md-4 col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">        
              <a href="#" class="pull-left"><?php echo $a0dn["name"] ?></a>         
              <a href="#" class="pull-right"><?php echo $this->get_age_string($entry->created); ?></a>

              <!--<div style="text-align: center;"><span class="label label-info"><?php echo $entry->created; ?></span></div>-->

            </div>      
            <div class="panel-body">

              <a href="<?php echo $this->route_url(NULL, 'entry', $entry->id);?>" class="blacklink">
                <?php echo $entry->body; ?>
              </a>
              <br>

              <div class="progress"><div class="progress-bar progress-bar-success" style="width: <?php echo rand(1,100);?>%"></div></div>

              <ul class="list-group">
                <li class="list-group-item">
                  <?php foreach ($tags as $tag) { ?>
                  <a href="<?php echo $this->route_url(NULL, 'tag', $tag); ?>"><span class="label label-warning"><?php echo $tag?></span></a>
                  <?php } ?>          
                </li>
                <li class="list-group-item">
                  <?php for ($i=0; $i < 1; $i++) { ?>
                    <img src="<?php echo $entry->image_url;?>" width="30px" height="30px">
                    <img src="https://trello-avatars.s3.amazonaws.com/7548032adad79c3b6a79399a54538e70/30.png" width="30px" height="30px">            
                    <img src="https://trello-avatars.s3.amazonaws.com/fa239ce6f62fe75578c65c51123c22b4/30.png" width="30px" height="30px">            
                    <img src="https://trello-avatars.s3.amazonaws.com/8d80f15f4b31c64e7c7d13d4d01e3af2/30.png" width="30px" height="30px">            
                  <?php } ?>            
                </li>
              </ul>       

              <div align="center"><span class="label label-info"><?php date_default_timezone_set('UTC'); $date = new DateTime($entry->created); echo $date->format('g:ia \o\n l jS F Y'); ?></span></div>
            </div>
          </div>
        </div>

  <?php

      }

      //$a = get_object_vars($actions);
      //print_r($a);
      //echo "<br>----------------------------<br>\n";
    }
    //echo "</pre>\n";

  ?>

  <?php foreach($entries as $entry) { ?>
  <div class="col-md-4 col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">        
        <a href="#" class="pull-left"><?php echo $settings->display_name; ?></a>         
        <a href="#" class="pull-right"><?php echo $this->get_age_string($entry->created); ?></a>

        <!--<div style="text-align: center;"><span class="label label-info"><?php echo $entry->created; ?></span></div>-->

      </div>      
      <div class="panel-body">

        <a href="<?php echo $this->route_url(NULL, 'entry', $entry->id);?>" class="blacklink">
          <?php echo $entry->body; ?>
        </a>
        <br>

        <div class="progress"><div class="progress-bar progress-bar-success" style="width: <?php echo rand(1,100);?>%"></div></div>

        <ul class="list-group">
          <li class="list-group-item">
            <?php foreach ($tags as $tag) { ?>
            <a href="<?php echo $this->route_url(NULL, 'tag', $tag); ?>"><span class="label label-warning"><?php echo $tag?></span></a>
            <?php } ?>          
          </li>
          <li class="list-group-item">
            <?php for ($i=0; $i < 1; $i++) { ?>
              <img src="<?php echo $entry->image_url;?>" width="30px" height="30px">
              <img src="https://trello-avatars.s3.amazonaws.com/7548032adad79c3b6a79399a54538e70/30.png" width="30px" height="30px">            
              <img src="https://trello-avatars.s3.amazonaws.com/fa239ce6f62fe75578c65c51123c22b4/30.png" width="30px" height="30px">            
              <img src="https://trello-avatars.s3.amazonaws.com/8d80f15f4b31c64e7c7d13d4d01e3af2/30.png" width="30px" height="30px">            
            <?php } ?>            
          </li>
        </ul>       

        <div align="center"><span class="label label-info"><?php date_default_timezone_set('UTC'); $date = new DateTime($entry->created); echo $date->format('g:ia \o\n l jS F Y'); ?></span></div>
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
-->
