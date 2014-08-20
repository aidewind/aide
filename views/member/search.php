<?php
  $sectors = $model['sectors'];
  $session =  $this->get_session();
?>

<!--main-->
<div class="container" id="main">
  <div class="row">

    <?php if($session != NULL) { ?>
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>New Member</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post" action="<?php echo $this->route_url('edit', 'member'); ?>">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <label for="complete_name">Complete Member Name</label>
          <input type="text" name="complete_name" required maxlength="63" value="<?php echo $model['complete_name']; ?>" />
          <label for="email">Email</label>          
          <input type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
          <label for="sectors">Member Sectors</label>
            <select name="sectors[]" size="3" multiple="multiple">
            <?php foreach($sectors as $sector) {
            echo"<option value=".$sector->id.">".$sector->name."</option>";
            }?>
            </select>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Member Information</button></span>
        </form>
      </div>
    </div>
    <?php } ?>

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