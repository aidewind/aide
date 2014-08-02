<h1>Account Administration</h1>
<h2>General Settings</h2>

<ul>
  <li><a href="<?php echo $this->route_url('settings'); ?>">Account Settings</a></li>
  <li><a href="<?php echo $this->route_url('password'); ?>">Update Password</a></li>
</ul>
<h2>Account Management</h2>
<ul>
  <li><a href="<?php echo $this->route_url('edit', 'ticket'); ?>">New Ticket</a></li>
</ul>
<table class="manage">
  <thead>
    <tr>
      <th class="left">Title</th><th>Published</th><th>Created</th><th>Manage</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($model as $ticket) { ?>
    <tr>
      <td><?php echo $ticket->title; ?></td>
      <td class="center"><?php echo $ticket->published == 1 ? 'Yes': 'No'; ?></td>
      <td class="center"><?php echo $this->get_age_string($ticket->created); ?></td>
      <td class="center">
        <a href="<?php echo $this->route_url('edit', 'ticket', $ticket->id); ?>">edit</a>
        <a href="<?php echo $this->route_url('delete', 'ticket', $ticket->id); ?>">delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>