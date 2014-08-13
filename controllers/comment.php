<?php

class CommentController extends Controller {

  public function edit($id = NULL) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    $this->meta->title = 'Comment Edit';

    $model = array(
      'id' => $this->post('id'),
      'body' => $this->post('body'),
      'account' => $this->post('account'),
      'ticket' => $this->post('ticket'),
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      $req = array();
      if(empty($model['body'])) {
        $req[] = 'Comment';
      }
      if(!empty($req)) {
        $model['error'] = 'Please enter the required fields: ' . implode(', ', $req);        
        return $this->view($model);
      }

      $comment = NULL;
      if(empty($model['id'])) {
        $comment = new comment();
      } else {
        $comment = comment::select_by_id($model['id']);
        if($comment === NULL) {
          $this->not_found();
        }
        if($comment === FALSE) {
          $model['error'] = 'Failed to load comment: ' . last_error();
          return $this->view($model);
        }
      }

      $comment->body = $model['body'];
      $comment->account = $model['account'];
      $comment->ticket = $model['ticket'];
      $res = empty($comment->id) ? $comment->insert() : $comment->update();
      $model['error'] = $res ? 'Saved successfully.' : 'Failed to save comment: ' . last_error(); 
      $model['id'] = $comment->id;

      if($res) {
        $this->redirect(NULL, 'ticket',"$comment->ticket");
      }
    }
    else {
      if(!empty($id)) {
        $comment = comment::select_by_id($id);
        if($comment === NULL) {
          $this->not_found();
        }
        if($comment === FALSE) {
          $model['error'] = 'Unable to load comment: ' . last_error();
        }
        else {
          $model['id'] = $comment->id;
          $model['body'] = $comment->body;
        }
      } 
    }

    $this->view($model);    
  }
}