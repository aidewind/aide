<!--main-->
<div class="container" id="main">
  <div class="row">

    <?php foreach($model['members'] as $member) { ?>
    <div class="col-md-4 col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">        
          <a href="<?php echo $this->route_url(NULL, 'member', $member->id); ?>" class="pull-left">Member <?php echo $member->id;?></a>
          <a href="mailto:<?php echo $member->email; ?>" class="pull-right"><?php echo $member->email; ?></a>
        </div>      
        <div class="panel-body">

          <?php echo $member->complete_name; ?>

          <a href="<?php echo $this->route_url(NULL, 'member', $member->id); ?>">view</a>
          <a href="<?php echo $this->route_url('edit', 'member', $member->id); ?>">edit</a>
          <a href="<?php echo $this->route_url('delete', 'member', $member->id); ?>">delete</a>

        </div>
      </div>
    </div>
    <?php } ?>
  </div>

</div>  