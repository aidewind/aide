<?php
  $session =  $this->get_session();
?>
<!--main-->
<div class="container" id="main">
  <div class="row">

    <?php if($session != NULL) { ?>        
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>New Sector</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post" action="<?php echo $this->route_url('edit', 'sector'); ?>">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <label for="display_name">Sector Name</label>
          <input type="text" name="name" required maxlength="63" value="<?php echo $model['name']; ?>" />
          <label for="email">Email</label>          
          <input type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
          <label for="display_name">Sector Initial</label>
          <input type="text" name="initial" required maxlength="63" value="<?php echo $model['initial']; ?>" />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Sector Information</button></span>
        </form>
      </div>
    </div>
    <?php } ?>

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