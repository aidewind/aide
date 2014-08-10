<!--main-->
<div class="container" id="main">
  <div class="row">


    <?php foreach($model['sectors'] as $sector) { ?>
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">        
          <a href="<?php echo $this->route_url(NULL, 'sector', $sector->id); ?>" class="pull-left">Sector <?php echo $sector->id;?></a>
          <a href="mailto:<?php echo $sector->name; ?>" class="pull-right"><?php echo $sector->name; ?></a>
        </div>      
        <div class="panel-body">

          <?php echo $sector->complete_name; ?>

          <a href="<?php echo $this->route_url(NULL, 'sector', $sector->id); ?>">view</a>
          <a href="<?php echo $this->route_url('edit', 'sector', $sector->id); ?>">edit</a>
          <a href="<?php echo $this->route_url('delete', 'sector', $sector->id); ?>">delete</a>

        </div>
      </div>
    </div>
    <?php } ?>

  </div>
</div>  