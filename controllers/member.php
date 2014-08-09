<?php

class MemberController extends Controller {
  protected $member_redirect = FALSE;
  protected $word;

  public function insert() {
    $this->meta->title = 'Insert';
    
    $model = array(
      'email' => $this->post('email'),
      'complete_name' => $this->post('complete_name'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['email'])) {
        $req[] = 'Email';
      }
      if(empty($model['complete_name'])) {
        $req[] = 'Your Complete Name';
      }
      if(!empty($req)) {
        $model['error'] = 'The following fields are required: ' . implode(', ', $req);
        return $this->view($model);
      }
      if(!filter_var($model['email'], FILTER_VALIDATE_EMAIL)) {
        $model['error'] = 'Please enter a valid email address.';
        return $this->view($model);
      }

      if($member === NULL) {
        $member = new member();
        $member->complete_name = $model['complete_name'];
        $member->email = $model['email'];
        if(!$member->insert()) {
          $model['error'] = 'Failed to create member' . last_error();
          return $this->view($model);
        }

        $this->redirect('index', 'member');
      }
    }

    $this->view($model);
  }

  public function index($word = NULL) {
    $settings = $this->get_settings();    
    if(empty($word)) {
      $this->meta->title = 'Member List';
      $members = member::select_list();
    } else {
      $this->meta->title = 'Member Related with  ' . $word . ' - ' .$settings->site_name;
      $members = member::select_by_word($word);
    }

    return $this->view(array('members' => $members));

  }

  public function profile() {
    if($this->get_session() == NULL) {      
      $this->redirect('signin');
    }
    if($session->account > 1) {
      $this->redirect('index');
    }

    $model = array(
      'site_name' => $this->post('site_name'),
      'complete_name' => $this->post('complete_name'),
      'email' => $this->post('email'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['site_name'])) {
        $req[] = 'site Name';
      }
      if(empty($model['complete_name'])) {
        $req[] = 'Your Name';
      }
      if(empty($model['email'])) {
        $req[] = 'Email';
      }
      if(!empty($req)) {
        $model['error'] = 'The following fields are required: ' . implode(', ', $req);
        return $this->view($model);
      }

      if(!filter_var($model['email'], FILTER_VALIDATE_EMAIL)) {
        $model['error'] = 'Please enter a valid email address.';
        return $this->view($model);
      }
      
      #todo: restrict to id 1 member
      $settings = $this->get_settings();
      $settings->site_name = $model['site_name'];
      if(!$settings->update()) {
        $model['error'] = 'Failed to update settings: ' . last_error();
        return $this->view($model);
      }
      
      
      #todo: alter to member
      #$member = $this
      $settings->complete_name = $model['complete_name'];
      $settings->email = $model['email'];      
      if(!$settings->update()) {
        $model['error'] = 'Failed to update settings: ' . last_error();
        return $this->view($model);
      }


      return $this->redirect(NULL);
    }
    else {
      $settings = $this->get_settings();
      $model['site_name'] = $settings->site_name;
      $model['complete_name'] = $settings->complete_name;
      $model['email'] = $settings->email;
    }
    $this->view($model);
  }
}

?>