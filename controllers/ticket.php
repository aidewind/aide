<?php

class ticketController extends Controller {

  public function index($id = NULL) {

    if(empty($id)) {
      $this->redirect(NULL, "home");
    }
    
    $settings = $this->get_settings();
    
    $ticket = ticket::select_by_id($id);
    if($ticket === NULL) {
      $this->not_found();
    }
    
    $this->meta->title = htmlentities($ticket->id . ' - ' . $settings->site_name);
    $this->meta->author = htmlentities($settings->display_name);
    $this->meta->description = htmlentities($ticket->body);

    $ticket_sectors = ticket_sector::select_by_ticket($ticket->id);
    $sectors = array();
    foreach($ticket_sectors as $ticket_sector) {
      $sectors[] = $ticket_sector->name;
    }
    $this->meta->keywords = htmlentities(implode(',', $sectors));

    $this->view(array('ticket' => $ticket, 'sectors' => $sectors));
  }

  public function edit($id = NULL) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    $this->meta->title = 'Ticket Edit';

    $model = array(
      'id' => $this->post('id'),
      'body' => $this->post('body'),
      'sectors'
       => $this->post('sectors'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['body'])) {
        $req[] = 'ToDo';
      }
      if(!empty($req)) {
        $model['error'] = 'Please enter the required fields: ' . implode(', ', $req);
        return $this->view($model);
      }

      $ticket = NULL;
      if(empty($model['id'])) {
        $ticket = new ticket();
      } else {
        $ticket = ticket::select_by_id($model['id']);
        if($ticket === NULL) {
          $this->not_found();
        }
        if($ticket === FALSE) {
          $model['error'] = 'Failed to load ticket: ' . last_error();
          return $this->view($model);
        }
      }

      $ticket->body = $model['body'];
      
      $res = empty($ticket->id) ? $ticket->insert() : $ticket->update();
      $model['error'] = $res ? 'Saved successfully.' : 'Failed to save ticket: ' . last_error(); 
      $model['id'] = $ticket->id;

      ticket_sector::delete_by_ticket($ticket->id);
      $sectors = explode(',', $model['sectors']);
      foreach($sectors as $name) {
        $name = trim($name);
        $sector = sector::find_or_create($name);
        $ticket_sector = new ticket_sector();
        $ticket_sector->ticket = $ticket->id;
        $ticket_sector->sector = $sector->id;
        $ticket_sector->insert();
      }
    }
    else {
      if(!empty($id)) {
        $ticket = ticket::select_by_id($id);
        if($ticket === NULL) {
          $this->not_found();
        }
        if($ticket === FALSE) {
          $model['error'] = 'Unable to load ticket: ' . last_error();
        }
        else {
          $model['id'] = $ticket->id;
          $model['body'] = $ticket->body;
        }

        $sectors = ticket_sector::select_by_ticket($ticket->id);
        if($sectors !== FALSE) {
          $t = array();
          foreach($sectors as $name) {
            $t[] = $name->name;
          }
          $model['sectors'] = implode(', ', $t);
        }
      } 
    }

    $this->view($model);
  }

  public function preview($id) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    if(empty($id)) {
      $this->not_found();
    }
    $settings = $this->get_settings();
    
    $ticket = ticket::select_by_id($id);
    if($ticket === NULL) {
      $this->not_found();
    }

    $this->meta->title = htmlentities($ticket->title . ' - ' . $settings->site_name);
    $this->meta->author = htmlentities($settings->display_name);
    $this->meta->description = htmlentities($ticket->snippet);
    if(!empty($ticket->image_url)) {
      $this->meta->image = $ticket->image_url;
    }

    $ticket_sectors = ticket_sector::select_by_ticket($ticket->id);
    $sectors = array();
    foreach($ticket_sectors as $ticket_sector) {
      $sectors[] = $ticket_sector->name;
    }
    $this->meta->keywords = htmlentities(implode(',', $sectors));

    $this->view(array('ticket' => $ticket, 'sectors' => $sectors), 'index');
  }

  public function delete($id) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    if(empty($id)) {
      $this->not_found();
    }
    
    $ticket = ticket::select_by_id($id);
    if($ticket === NULL) {
      $this->not_found();
    }
    
    $model = array(
      'ticket' => $ticket, 
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      if(!$ticket->delete()) {
        $model['error'] = 'Failed to delete ticket: ' . last_error();
      }
      else {
        $this->redirect(NULL, 'admin');
      }
    }

    $this->meta->title = 'Delete Ticket';
    $this->view($model);
  }
}

?>