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