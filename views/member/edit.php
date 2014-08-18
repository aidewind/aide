<?php
  $sectors = $model['sectors'];
  $sector_member = $model['sector_member'];
  $model = $model['model']; 
  
  $selected = array();
  $selected = array_fill(0, count($sectors), false);
  foreach ($sector_member as $s_m){
    $selected[$s_m->id]=true;
  }
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
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
              echo"<option value=".$sector->id;
              if ($selected[$sector->id]){
                echo " selected='selected' ";
              } 
              echo ">".$sector->name."</option>";
            }?>
            </select>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Member Information</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  
