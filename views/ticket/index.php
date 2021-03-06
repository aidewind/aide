<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $ticket = $model['ticket'];
  $members = $model['members'];
  $members_involved = $model['members_involved'];
  $sectors = $model['sectors'];
  $sectors_involved = $model['sectors_involved'];
  $comments = $model['comments'];
  $session =  $this->get_session();
?>
<!--main-->
<div class="container" id="main">

  <div class="row">
    <div class="col-md-12 col-sm-6">
      <div class="well"> 
        <h4 class="title"><div class="markdown"><?php echo $parsedown->text(strip_tags (mb_substr($ticket->body,0,300)));?></div></h4>
        <p class="info"><?php echo $this->get_age_string($ticket->created), ' by ', $session->account;?></p>
      </div>
    </div>
    
     <div class="col-md-4 col-sm-6">
        <div class="well">
          <?php if($session != NULL) { ?>        
          <ul class="nav nav-tabs">
            <li class="active"><a href="#A" data-toggle="tab">Member</a></li>
            <li><a href="#B" data-toggle="tab">Sector</a></li>
            <li><a href="#C" data-toggle="tab">Item</a></li>
            <li><a href="#D" data-toggle="tab">Set</a></li>
          </ul>
          <div class="tabbable">
            <div class="tab-content">
            <div class="tab-pane active" id="A">
              <div class="well well-sm">
                <form method="post" action="<?php echo $this->route_url('involve', 'member'); ?>" class="form-horizontal" role="form">
                  <div class="input-group">
                    <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
                    <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
                    <select name='member'>
                      <?php foreach($members as $member) { ?>
                      <option value="<?php echo $member->id; ?>"><?php echo $member->complete_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Add Member</button></span>
                </form>
              </div>
            </div>
            <div class="tab-pane" id="B">
              <div class="well well-sm">
                <form method="post" action="<?php echo $this->route_url('involve', 'sector'); ?>" class="form-horizontal" role="form">
                  <div class="input-group">
                    <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
                    <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
                    <select name='sector'>
                      <?php foreach($sectors as $sector) { ?>
                      <option value="<?php echo $sector->id; ?>"><?php echo $sector->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Add Sector</button></span>
                </form>
              </div>
            </div>
            <div class="tab-pane" id="C">
              <div class="well well-sm">
                <p class="error"><?php //echo $model['error']; ?></p>
                <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>" class="form-horizontal" role="form">
                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php //echo $model['id']; ?>" />
                    <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
                    <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
                    <input name="body" type="text" class="form-control" placeholder="Add a comment..">
                    <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Save Comment</button></span>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane" id="D">
              <div class="well well-sm">
                <p class="error"><?php //echo $model['error']; ?></p>
                <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>" class="form-horizontal" role="form">
                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php //echo $model['id']; ?>" />
                    <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
                    <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
                    <input name="body" type="text" class="form-control" placeholder="Add a comment..">
                    <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Save Comment</button></span>
                  </div>
                </form>
              </div>
            </div>

            </div>
          </div> <!-- /tabbable -->
          <?php } ?>

          <ul class="list-group">          
            <li class="list-group-item">
            <b><p>Members</p></b>
            <?php foreach($members_involved as $member) { ?>            
              <span class="label label-default"><?php echo $member->member; ?></span>
            <?php } ?>
            </li>

            <li class="list-group-item">
            <b><p>Sectors</p></b>
            <?php foreach($sectors_involved as $sector) { ?>            
              <span class="label label-default"><?php echo $sector->sector; ?></span>
            <?php } ?>
            </li>

            <li class="list-group-item">
            <b><p>Itens</p></b>
            <?php foreach($members_involved as $member) { ?>            
              <span class="label label-default"><?php echo $member->member; ?></span>
            <?php } ?>
            </li>

            <li class="list-group-item">
            <b><p>Sets</p></b>
            <?php foreach($sectors_involved as $sector) { ?>            
              <span class="label label-default"><?php echo $sector->sector; ?></span>
            <?php } ?>
            </li>
          </ul>
        </div>
    </div>

    <div class="col-md-8 col-sm-6">
      <div class="well"> 
        <div class="progress">
          <div class="progress-bar progress-bar-success" style="width: <?php echo rand(1,100);?>%"></div>
        </div>        
      </div>
    </div>

    <div class="col-md-8 col-sm-6">
      <div class="well">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#E" data-toggle="tab">List1</a></li>
          <li><a href="#F" data-toggle="tab">List2</a></li>
        </ul>
        <div class="tabbable">
          <div class="tab-content">
          <div class="tab-pane active" id="E">
            <div class="well well-sm">
              <ul class="list-group">
              <?php foreach ($comments as $comment) { ?>
                <li class="list-group-item">
                  <input type="checkbox" name="<?php echo $comment[account]?>" value="<?php echo $comment[body];?>"> <?php echo $comment[body]; ?>
                </li>
              <?php } ?>
              </ul>
              <?php if($session != NULL) { ?> 
                <p class="error"><?php //echo $model['error']; ?></p>
                <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>" class="form-horizontal" role="form">
                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php //echo $model['id']; ?>" />
                    <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
                    <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
                    <input name="body" type="text" class="form-control" placeholder="Add a comment..">
                    <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Save Comment</button></span>
                  </div>
                </form>
              <?php } ?>
            </div>
          </div>

          <div class="tab-pane" id="F">
            <div class="well well-sm">
              <ul class="list-group">
              <?php foreach ($comments as $comment) { ?>
                <li class="list-group-item">
                  <input type="checkbox" name="<?php echo $comment[account]?>" value="<?php echo $comment[body];?>"> <?php echo $comment[body]; ?>
                </li>
              <?php } ?>
              </ul>
              <?php if($session != NULL) { ?> 
                <p class="error"><?php //echo $model['error']; ?></p>
                <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>" class="form-horizontal" role="form">
                  <div class="input-group">
                    <input type="hidden" name="id" value="<?php //echo $model['id']; ?>" />
                    <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
                    <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
                    <input name="body" type="text" class="form-control" placeholder="Add a comment..">
                    <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Save Comment</button></span>
                  </div>
                </form>
              <?php } ?>
            </div>
          </div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-6">
      <div class="well">         
        <ul class="list-group">                
          <li class="list-group-item">
          <b><p>Comments</p></b>
          <?php if($session != NULL) { ?> 
          <p class="error"><?php //echo $model['error']; ?></p>
          <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>" class="form-horizontal" role="form">
            <div class="input-group">
              <input type="hidden" name="id" value="<?php //echo $model['id']; ?>" />
              <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
              <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
              <input name="body" type="text" class="form-control" placeholder="Add a comment..">
              <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Save Comment</button></span>
            </div>
          </form>
          <?php } ?>
          <?php foreach ($comments as $comment) { 
              echo '<hr>'.$comment[account].": ".$comment[body].'<br>';
          } ?>
          </li>
        </ul>
      </div>
    </div>
  </div>

</div>  