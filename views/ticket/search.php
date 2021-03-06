<?php
  $session =  $this->get_session();
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <?php if($session != NULL) { ?>
    <div class="col-md-3 col-sm-6">
      <div class="well"> 
        <h4>New Ticket</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post" action="<?php echo $this->route_url('edit', 'ticket');?>">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
          <textarea name="body" rows="4"><?php echo $model['body']; ?></textarea>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Ticket</button></span>
        </form>
      </div>
    </div>
    <?php } ?>

    <?php foreach($model['tickets'] as $ticket) { ?>
      <div class="col-md-3 col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">        
            <a href="#" class="pull-left"><?php echo $settings->display_name; ?></a>         
            <a href="#" class="pull-right"><?php echo $this->get_age_string($ticket->created); ?></a>
          </div>      
          <div class="panel-body">

            <a href="<?php echo $this->route_url(NULL, 'ticket', $ticket->id);?>" class="blacklink">
              <?php echo  strip_tags (mb_substr($ticket->body,0,100)); ?>
            </a>
            <br>

            <div class="progress"><div class="progress-bar progress-bar-success" style="width: <?php echo rand(1,100);?>%"></div></div>

            <ul class="list-group">
              <li class="list-group-item">
                <?php foreach ($sectors as $sector) { ?>
                <a href="<?php echo $this->route_url(NULL, 'sector', $sector); ?>"><span class="label label-warning"><?php echo $sector?></span></a>
                <?php } ?>          
              </li>
              <li class="list-group-item">
                <?php for ($i=0; $i < 1; $i++) { ?>
                <img src="<?php echo $ticket->image_url;?>" width="30px" height="30px">
                <img src="https://trello-avatars.s3.amazonaws.com/7548032adad79c3b6a79399a54538e70/30.png" width="30px" height="30px">            
                <img src="https://trello-avatars.s3.amazonaws.com/fa239ce6f62fe75578c65c51123c22b4/30.png" width="30px" height="30px">            
                <img src="https://trello-avatars.s3.amazonaws.com/8d80f15f4b31c64e7c7d13d4d01e3af2/30.png" width="30px" height="30px">            
                <?php } ?>            
              </li>
              <li class="list-group-item">
                <a href="<?php echo $this->route_url(NULL, 'ticket', $ticket->id); ?>">view</a>
                <a href="<?php echo $this->route_url('edit', 'ticket', $ticket->id); ?>">edit</a>
                <a href="<?php echo $this->route_url('delete', 'ticket', $ticket->id); ?>">delete</a>                        
              </li>
            </ul>       

            <div align="center"><span class="label label-info"><?php date_default_timezone_set('UTC'); $date = new DateTime($ticket->created); echo $date->format('g:ia \o\n l jS F Y'); ?></span></div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>  