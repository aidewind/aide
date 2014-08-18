<?php

class MemberController extends Controller {
  protected $member_redirect = FALSE;
  protected $word;

  public function index($id = NULL) {
    if(empty($id)) {
      $this->redirect(NULL, "home");
    }
    
    $settings = $this->get_settings();
    
    $member = member::select_by_id($id);
    if($member === NULL) {
      $this->not_found();
    }
    
    $this->meta->title = htmlentities($member->id . ' - ' . $settings->site_name);
    $this->meta->author = htmlentities($smember->complete_name);
    $this->meta->description = htmlentities($meber->email);

/*
    $member_sectors = member_sector::select_by_member($member->id);
    $sectors = array();
    foreach($member_sectors as $member_sector) {
      $sectors[] = $member_sector->name;
    }
    $this->meta->keywords = htmlentities(implode(',', $sectors));
*/
    $this->view(array('member' => $member, 'sectors' => $sectors));  
  }

  public function search($word = NULL) {
    $settings = $this->get_settings();    
    if(empty($word)) {
      $this->meta->title = 'Member Search';
      $members = member::select_list();
      $sectors = sector::select_list();
    } else {
      $this->meta->title = 'Member Related with  ' . $word . ' - ' .$settings->site_name;
      $members = member::select_by_word($word);
    }
    return $this->view(array('members' => $members, 'sectors' => $sectors));
  }

  public function delete($id) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    if(empty($id)) {
      $this->not_found();
    }
    
    $member = member::select_by_id($id);
    if($member === NULL) {
      $this->not_found();
    }
    
    $model = array(
      'member' => $member, 
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      if(!$member->delete()) {
        $model['error'] = 'Failed to delete member: ' . last_error();
      }
      else {
        $this->redirect('search', 'member');
      }
    }

    $this->meta->title = 'Delete Member';
    $this->view($model);
  }

  public function edit($id = NULL) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    $this->meta->title = 'Member Edit';

    $model = array(
      'id' => $this->post('id'),
      'email' => $this->post('email'),
      'complete_name' => $this->post('complete_name'),
      'account' => $this->post('account'),
      'sectors' => $this->post('sectors'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['email'])) {
        $req[] = 'Email';
      }
      if(empty($model['complete_name'])) {
        $req[] = 'Complete Name';
      }
      if(!empty($req)) {
        $model['error'] = 'Please enter the required fields: ' . implode(', ', $req);
        return $this->view($model);
      }

      $member = NULL;
      if(empty($model['id'])) {
        $member = new member();
      } else {
        $member = member::select_by_id($model['id']);
        if($member === NULL) {
          $this->not_found();
        }
        if($member === FALSE) {
          $model['error'] = 'Failed to load member: ' . last_error();
          return $this->view($model);
        }
      }

      $member->email = $model['email'];
      $member->complete_name = $model['complete_name'];

      $res = empty($member->id) ? $member->find_or_create() : $member->update();

      $model['error'] = $res ? 'Saved successfully.' : 'Failed to save member: ' . last_error(); 
      
      sector_member::delete_by_member($model['id']);

      $n =  sizeof($model['sectors']);
      $sector = $model['sectors'];

      for($i=0; $i<$n; $i++) {
        $sector_member = new sector_member();
        $sector_member->member = $model['id'];
        $sector_member->sector = $sector[$i];
        $sector_member->insert();
      }

      $this->redirect(NULL, 'member', 'search');

    } else {
      if(!empty($id)) {
        $member = member::select_by_id($id);

        if($member === NULL) {
          $this->not_found();
        }
        if($member === FALSE) {
          $model['error'] = 'Unable to load member: ' . last_error();
        } else {
          $model['id'] = $member->id;
          $model['email'] = $member->email;
          $model['complete_name']= $member->complete_name;
        }

        $sector_member = sector_member::select_by_member($member->id);
      } 
    }

    $sectors = sector::select_list();
    $this->view(array('model' => $model, 'sectors' => $sectors, 'sector_member' => $sector_member));
  }

  public function involve($id = NULL) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    $this->meta->title = 'Involve member on ticket';

    $model = array(
      'id' => $this->post('id'),
      'member' => $this->post('member'),
      'account' => $this->post('account'),
      'ticket' => $this->post('ticket'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['member'])) {
        $req[] = 'Member';
      }
      if(!empty($req)) {
        $model['error'] = 'Please enter the required fields: ' . implode(', ', $req);        
        return $this->view($model);
      }

      $ticket_member = NULL;
      if(empty($model['id'])) {
        $ticket_member = new ticket_member();
      } else {
        $ticket_member = ticket_member::select_by_id($model['id']);
        if($ticket_member === NULL) {
          $this->not_found();
        }
        if($ticket_member === FALSE) {
          $model['error'] = 'Failed to load ticket_member: ' . last_error();
          return $this->view($model);
        }
      }

      $ticket_member->member = $model['member'];
      $ticket_member->account = $model['account'];
      $ticket_member->ticket = $model['ticket'];
      $res = empty($ticket_member->id) ? $ticket_member->insert() : $ticket_member->update();
      $model['error'] = $res ? 'Saved successfully.' : 'Failed to save ticket_member: ' . last_error(); 
      $model['id'] = $ticket_member->id;

      //if($res) {
        $this->redirect(NULL, 'ticket',"$ticket_member->ticket");
      //}
    } else {
      if(!empty($id)) {
        $ticket_member = ticket_member::select_by_id($id);
        if($ticket_member === NULL) {
          $this->not_found();
        }
        if($ticket_member === FALSE) {
          $model['error'] = 'Unable to load ticket_member: ' . last_error();
        } else {
          $model['id'] = $ticket_member->id;
          $model['member'] = $ticket_member->member;
        }
        return $this->view($model);
      } 
      $this->redirect(NULL, 'ticket','search');
    }        
  }  

}
?>