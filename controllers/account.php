<?php

class AccountController extends Controller {
  protected $account_redirect = FALSE;

  public function signup() {
    $this->meta->title = 'Sign Up';
    
    $model = array(
      'email' => $this->post('email'),
      'display_name' => $this->post('display_name'),
      'password' => $this->post('password'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['email'])) {
        $req[] = 'Email';
      }
      if(empty($model['display_name'])) {
        $req[] = 'Your Account Name';
      }
      if(empty($model['password'])) {
        $req[] = 'Password';
      }
      if(!empty($req)) {
        $model['error'] = 'The following fields are required: ' . implode(', ', $req);
        return $this->view($model);
      }
      if(!filter_var($model['email'], FILTER_VALIDATE_EMAIL)) {
        $model['error'] = 'Please enter a valid email address.';
        return $this->view($model);
      }
      if(strlen($model['password']) < 6) {
        $model['error'] = 'Please enter a password that is at least 6 characters.';
        return $this->view($model);
      }
      if($account === NULL) {
        $account = new account();
        $account->display_name = $model['display_name'];
        $account->email = $model['email'];
        $account->password_salt = uniqid();
        $account->password_hash = hash('sha512', $model['password'] . $account->password_salt);
        if(!$account->insert()) {
          $model['error'] = 'Failed to create account' . last_error();
          return $this->view($model);
        }
        
        $message = " To activate your account, please click on this link:";
        $message .= 'http://' . $_SERVER[HTTP_HOST] . $this->route_url('activate', 'account', '?email=' . $account->email . '&key=' . $account->password_salt);
        mail($account->email, 'Registration Confirmation', $message);
        
        $session = new session();
        $session->code = uniqid();
        $session->account = $account->id;
        if(!$session->insert()) {
          $model['error'] = 'Failed to create new session: ' . last_error();
          return $this->view($model);
        }
        $session = session::select_by_id($session->id);
        if($session === NULL) {
          $model['error'] = 'Failed to load new session: ' . last_error();
          return $this->view($model);
        }
        $this->set_session($session);
        $this->redirect(NULL);
      }
    }

    $this->view($model);
  }

  public function activate(){
    $settings = $this->get_settings();

    $model = array (
      'email' => $this->get('email'),
      'key' => $this->get('key'),
      'error' => NULL
    );

    if(empty($model['email']) || empty($model['key'])) {
      $model['error'] = 'Please enter both an email and a key.';
      return $this->view($model);
    }
    if(!filter_var($model['email'], FILTER_VALIDATE_EMAIL)) {
      $model['error'] = 'Please enter a valid email address.';
      return $this->view($model);
    }
    if(!account::activate($model['email'],$model['key'])) {
      $model['error'] = 'Your account could not be activated. Please recheck the link or contact the system administrator.';      
      return $this->view($model);
    }

    $model['error'] = 'Your account was activated.';
    return $this->view($model);
  }

  public function index() {
    if($this->get_session() == NULL) {
      $this->redirect('signin');
    }

    $settings = $this->get_settings();

    $account = account::select_by_id($this->get_session()->account);
    if(!$account->active){
      $model = array(
        'error'=> 'A confirmation email has been sent to '.$account->email.' Please click on the Activation Link to Activate your account'
      );
      $this->view($model);
    }
    
    $this->redirect(NULL, 'home');
  }

  public function signin() {
    if($this->get_session() !== NULL) {
      $this->redirect('index');
    }
    $this->meta->title = 'Sign In';
    
    $model = array(
      'email' => $this->post('email'), 
      'password' => $this->post('password'),
      'error' => NULL);

    if(array_key_exists('submit', $_POST)) {
      if(empty($model['email']) || empty($model['password'])) {
        $model['error'] = 'Please enter a email and password';
        return $this->view($model);
      }

      $account = account::select_by_email($model['email']);

      $hash = hash('sha512', $model['password'] . $account->password_salt);
      if(strcmp($model['email'], $account->email) !== 0 ||
        strcmp($hash, $account->password_hash) !== 0) {
        $model['error'] = 'That email/password combination was not valid.';
        return $this->view($model);
      }

      $session = new session();
      $session->code = uniqid();
      $session->account = $account->id;
      if(!$session->insert()) {
        $model['error'] = 'Failed to create new session: ' . last_error();
        return $this->view($model);
      }

      $session = session::select_by_id($session->id);
      if($session === NULL) {
        $model['error'] = 'Failed to load new session: ' . last_error();
        return $this->view($model);
      }
      $this->set_session($session);
      $this->redirect(NULL);
    }
    
    $this->view($model);
  }

  public function associate($id = NULL){
    if($this->get_session() == NULL) {
      $this->redirect('signin');
    }

    $model = array(
      'account' => $this->post('account'),
      'associate-account' => $this->post('associate-account'),
      'member' => $this->post('member'),      
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $res = account::associate($model['account'],$model['member']);
    }


    if($id !== NULL){
      $account = account::select_by_id($id);
    }    
    $members = member::select_list();
    $settings = $this->get_settings();
    $this->view(array('members' => $members, 'model' => $model, 'account' => $account));
  }

  public function password() {
    if($this->get_session() == NULL) {
      $this->redirect('signin');
    }
    
    $settings = $this->get_settings();

    $this->meta->title = 'Update Password';

    $model = array(
      'password' => $this->post('password'),
      'confirm' => $this->post('confirm'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      if(empty($model['password']) || empty($model['confirm'])) {
        $model['error'] = 'Please enter both a password and confirm password.';
        return $this->view($model);
      }

      if(strlen($model['password']) < 6) {
        $model['error'] = 'Please enter a password that is at least 6 characters.';
        return $this->view($model);
      }

      if(strcmp($model['password'], $model['confirm']) !== 0) {
        $model['error'] = 'The passwords do not match.';
        return $this->view($model);
      }
      
      $settings->password_hash = hash('sha512', $model['password'] . $settings->password_salt);
      
      if(!$settings->update()) {
        $model['error'] = 'Failed to update password: ' . last_error();
        return $this->view($model);
      }
      $this->redirect(NULL);
    }

    $this->view($model);
  }


  public function settings() {
    if($this->get_session() == NULL) {
      $this->redirect('signin');
    }

    $model = array(
      'site_name' => $this->post('site_name'),
      'display_name' => $this->post('display_name'),
      'email' => $this->post('email'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['site_name'])) {
        $req[] = 'site Name';
      }
      if(empty($model['display_name'])) {
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
      
      #todo: restrict to id 1 account
      $settings = $this->get_settings();
      $settings->site_name = $model['site_name'];
      if(!$settings->update()) {
        $model['error'] = 'Failed to update settings: ' . last_error();
        return $this->view($model);
      }
      
      
      #todo: alter to account
      #$account = $this
      $settings->display_name = $model['display_name'];
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
      $model['display_name'] = $settings->display_name;
      $model['email'] = $settings->email;
    }
    $this->view($model);
  }

  public function signout() {
    $this->set_session(NULL);
    $this->redirect(NULL, "home");
  }
}

?>