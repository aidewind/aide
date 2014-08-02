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
        <li class="active"><a href="#">~admin</a></li>
        <?php //$this->render_boards(); ?>
      </ul>
    </div>  
  </div> 
</div>  

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Ticket Management</h4>
        <ul>
          <li><a href="<?php echo $this->route_url('edit', 'entry'); ?>">New Ticket</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="row">
    <?php foreach($model as $entry) { ?>
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">        
          <a href="#" class="pull-left">published: <?php echo $entry->published == 1 ? 'Yes': 'No'; ?></a>
          <a href="#" class="pull-right"><?php echo $this->get_age_string($entry->created); ?></a>
        </div>      
        <div class="panel-body">

          <?php echo $entry->title; ?>
          <a href="<?php echo $this->route_url('edit', 'entry', $entry->id); ?>">edit</a>
          <a href="<?php echo $this->route_url('delete', 'entry', $entry->id); ?>">delete</a>

        </div>
      </div>
    </div>
    <?php } ?>
  </div>

</div>  