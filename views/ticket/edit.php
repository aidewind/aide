<div class="navbar navbar-default" id="subnav">
  <div class="col-md-12">
    <div class="navbar-header">
      <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> General Settings <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
      <ul class="nav dropdown-menu">
        <li><a href="<?php echo $this->route_url('password','admin'); ?>"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Update Password</a></li>
        <li><a href="<?php echo $this->route_url('settings','admin'); ?>"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
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
        <li><a href="<?php echo $this->route_url(NULL,'admin'); ?>">~admin</a></li>
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
        <h4>Ticket Edit</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <label for="body">ToDo</label>
          <textarea name="body" rows="8"><?php echo $model['body']; ?></textarea>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Ticket</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  