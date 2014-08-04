<div class="navbar navbar-default" id="subnav">
  <div class="col-md-12">
    <div class="navbar-header">
      <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> General Settings <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
      <ul class="nav dropdown-menu">
        <li><a href="<?php echo $this->route_url('signout'); ?>"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Sign Out</a></li>
        <li><a href="<?php echo $this->route_url(NULL, 'ticket'); ?>"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> My Tickets</a></li>
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
        <h4><a href="<?php echo $this->route_url('edit', 'ticket'); ?>">New Ticket</a></h4>
      </div>
    </div>
  </div>

  <div class="row">
    <?php foreach($model as $ticket) { ?>
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">        
          <a href="#" class="pull-left">Ticket <?php echo $ticket->id;?></a>
          <a href="#" class="pull-right"><?php echo $this->get_age_string($ticket->created); ?></a>
        </div>      
        <div class="panel-body">

          <?php echo $ticket->body; ?>

          <a href="<?php echo $this->route_url(NULL, 'ticket', $ticket->id); ?>">view</a>
          <a href="<?php echo $this->route_url('edit', 'ticket', $ticket->id); ?>">edit</a>
          <a href="<?php echo $this->route_url('delete', 'ticket', $ticket->id); ?>">delete</a>

        </div>
      </div>
    </div>
    <?php } ?>
  </div>

</div>  