<?php

class AccountController extends Controller {
  protected $accounts_redirect = FALSE;

  public function index() {
    $this->meta->title = 'Account Creation';
    
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
        $req[] = 'Your Name';
      }
      if(empty($model['password'])) {
        $req[] = 'Password';
      }
      if(!empty($req)) {
        $model['error'] = 'The following fields are required: ' . implode(', ', $req);
        return $this->partial($model);
      }
      if(!filter_var($model['email'], FILTER_VALIDATE_EMAIL)) {
        $model['error'] = 'Please enter a valid email address.';
        return $this->partial($model);
      }
      if(strlen($model['password']) < 6) {
        $model['error'] = 'Please enter a password that is at least 6 characters.';
        return $this->partial($model);
      }
      if($accounts === NULL) {
        $accounts = new account();
        $accounts->display_name = $model['display_name'];
        $accounts->email = $model['email'];
        $accounts->password_salt = uniqid();
        $accounts->password_hash = hash('sha512', $model['password'] . $accounts->password_salt);
        if(!$accounts->insert()) {
          $model['error'] = 'Failed to create initial accounts: ' . last_error();
          return $this->partial($model);
        }

        $this->redirect(NULL, 'home');
      }
    }

    $this->partial($model);
  }
}

?>