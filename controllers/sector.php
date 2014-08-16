<?php

class SectorController extends Controller {
  protected $page;
  protected $sector;
  protected $word;

  public function closure($id = NULL){
    if(empty($id)) {
      $this->redirect(NULL, "home");
    }
    
    $settings = $this->get_settings();
    
    $sectors = sector_closure::select_descendants_of($id);

    //var_dump($sectors);
    //stop();

    if($sectors === NULL) {
      $this->not_found();
    }
    
    $this->view(array('sectors' => $sectors));
  }

  public function index($id = NULL) {
    if(empty($id)) {
      $this->redirect(NULL, "home");
    }
    
    $settings = $this->get_settings();
    
    $sector = sector::select_by_id($id);
    if($sector === NULL) {
      $this->not_found();
    }
    
    $this->meta->title = htmlentities($sector->id . ' - ' . $settings->site_name);
    $this->meta->author = htmlentities($ssector->complete_name);
    $this->meta->description = htmlentities($meber->email);

/*
    $sector_sectors = sector_sector::select_by_sector($sector->id);
    $sectors = array();
    foreach($sector_sectors as $sector_sector) {
      $sectors[] = $sector_sector->name;
    }
    $this->meta->keywords = htmlentities(implode(',', $sectors));
*/
    $this->view(array('sector' => $sector, 'sectors' => $sectors));  
  }

  public function search($word = NULL) {
    $settings = $this->get_settings();    
    if(empty($word)) {
      $this->meta->title = 'Sector Search';
      $sectors = sector::select_list();
    } else {
      $this->meta->title = 'Sector Related with  ' . $word . ' - ' .$settings->site_name;
      $sectors = sector::select_by_word($word);
    }
    return $this->view(array('sectors' => $sectors));
  }

  public function delete($id) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    if(empty($id)) {
      $this->not_found();
    }
    
    $sector = sector::select_by_id($id);
    if($sector === NULL) {
      $this->not_found();
    }
    
    $model = array(
      'sector' => $sector, 
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      if(!$sector->delete()) {
        $model['error'] = 'Failed to delete sector: ' . last_error();
      }
      else {
        $this->redirect('search', 'sector');
      }
    }

    $this->meta->title = 'Delete Sector';
    $this->view($model);
  }

  public function edit($id = NULL) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    $this->meta->title = 'Sector Edit';

    $model = array(
      'id' => $this->post('id'),
      'name' => $this->post('name'),
      'email' => $this->post('email'),
      'initial' => $this->post('initial'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['name'])) {
        $req[] = 'Sector Name';
      }
      if(empty($model['email'])) {
        $req[] = 'Email';
      }
      if(empty($model['name'])) {
        $req[] = 'Sector Initial';
      }
      if(!empty($req)) {
        $model['error'] = 'Please enter the required fields: ' . implode(', ', $req);
        return $this->view($model);
      }
      if(!filter_var($model['email'], FILTER_VALIDATE_EMAIL)) {
        $model['error'] = 'Please enter a valid email address.';
        return $this->view($model);
      }

      $sector = NULL;
      if(empty($model['id'])) {
        $sector = new sector();
      } else {
        $sector = sector::select_by_id($model['id']);
        if($sector === NULL) {
          $this->not_found();
        }
        if($sector === FALSE) {
          $model['error'] = 'Failed to load sector: ' . last_error();
          return $this->view($model);
        }
      }

      $sector->name = $model['name'];
      $sector->email = $model['email'];
      $sector->initial = $model['initial'];      
      
      $res = empty($sector->id) ? $sector->insert() : $sector->update();
      $model['error'] = $res ? 'Saved successfully.' : 'Failed to save sector: ' . last_error(); 
      $model['id'] = $sector->id;
/*
      sector_sector::delete_by_sector($sector->id);
      $sectors = explode(',', $model['sectors']);
      foreach($sectors as $name) {
        $name = trim($name);
        $sector = sector::find_or_create($name);
        $sector_sector = new sector_sector();
        $sector_sector->sector = $sector->id;
        $sector_sector->sector = $sector->id;
        $sector_sector->insert();
      }
*/      
      if ($res) {
        $this->redirect("search", "sector");
      }
    } else {
      if(!empty($id)) {
        $sector = sector::select_by_id($id);
        if($sector === NULL) {
          $this->not_found();
        }
        if($sector === FALSE) {
          $model['error'] = 'Unable to load sector: ' . last_error();
        }
        else {
          $model['id'] = $sector->id;
          $model['name'] = $sector->name;
          $model['email'] = $sector->email;          
          $model['initial'] = $sector->initial;
        }
/*
        $sectors = sector_sector::select_by_sector($sector->id);
        if($sectors !== FALSE) {
          $t = array();
          foreach($sectors as $name) {
            $t[] = $name->name;
          }
          $model['sectors'] = implode(', ', $t);
        }
*/
      } 
    }

    $this->view($model);
  }


  public function involve($id = NULL) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    $this->meta->title = 'Involve sector on ticket';

    $model = array(
      'id' => $this->post('id'),
      'sector' => $this->post('sector'),
      'account' => $this->post('account'),
      'ticket' => $this->post('ticket'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['sector'])) {
        $req[] = 'Member';
      }
      if(!empty($req)) {
        $model['error'] = 'Please enter the required fields: ' . implode(', ', $req);        
        return $this->view($model);
      }

      $ticket_sector = NULL;
      if(empty($model['id'])) {
        $ticket_sector = new ticket_sector();
      } else {
        $ticket_sector = ticket_sector::select_by_id($model['id']);
        if($ticket_sector === NULL) {
          $this->not_found();
        }
        if($ticket_sector === FALSE) {
          $model['error'] = 'Failed to load ticket_sector: ' . last_error();
          return $this->view($model);
        }
      }

      $ticket_sector->sector = $model['sector'];
      $ticket_sector->account = $model['account'];
      $ticket_sector->ticket = $model['ticket'];
      $res = empty($ticket_sector->id) ? $ticket_sector->insert() : $ticket_sector->update();
      $model['error'] = $res ? 'Saved successfully.' : 'Failed to save ticket_sector: ' . last_error(); 
      $model['id'] = $ticket_sector->id;

      if($res) {
        $this->redirect(NULL, 'ticket',"$ticket_sector->ticket");
      }
    } else {
      if(!empty($id)) {
        $ticket_sector = ticket_sector::select_by_id($id);
        if($ticket_sector === NULL) {
          $this->not_found();
        }
        if($ticket_sector === FALSE) {
          $model['error'] = 'Unable to load ticket_sector: ' . last_error();
        } else {
          $model['id'] = $ticket_sector->id;
          $model['sector'] = $ticket_sector->sector;
        }
        return $this->view($model);
      } 
      $this->redirect(NULL, 'ticket','search');
    }        
  }  
}

?>