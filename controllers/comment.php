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
/*
      comment_sector::delete_by_comment($comment->id);
      $sectors = explode(',', $model['sectors']);
      foreach($sectors as $name) {
        $name = trim($name);
        $sector = sector::find_or_create($name);
        $comment_sector = new comment_sector();
        $comment_sector->comment = $comment->id;
        $comment_sector->sector = $sector->id;
        $comment_sector->insert();
      }
*/      

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
/*
        $sectors = comment_sector::select_by_comment($comment->id);
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

  public function index($id = NULL) {

    if(empty($id)) {
      $this->redirect(NULL, "home");
    }
    
    $settings = $this->get_settings();
    
    $comment = comment::select_by_id($id);
    if($comment === NULL) {
      $this->not_found();
    }
    
    $this->meta->title = htmlentities($comment->id . ' - ' . $settings->site_name);
    $this->meta->author = htmlentities($settings->display_name);
    $this->meta->description = htmlentities($comment->body);
/*
    $comment_sectors = comment_sector::select_by_comment($comment->id);
    $sectors = array();
    foreach($comment_sectors as $comment_sector) {
      $sectors[] = $comment_sector->name;
    }
    $this->meta->keywords = htmlentities(implode(',', $sectors));
*/
    $this->view(array('comment' => $comment, 'sectors' => $sectors));
  }

  public function search($word = NULL) {
    $settings = $this->get_settings();    
    if(empty($word)) {
      $this->meta->title = 'Comment Search';
      $comments = comment::select_list();
    } else {
      $this->meta->title = 'Comment Related with  ' . $word . ' - ' .$settings->site_name;
      $comments = comment::select_by_word($word);
    }
    return $this->view(array('comments' => $comments));
  }

  public function preview($id) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    if(empty($id)) {
      $this->not_found();
    }
    $settings = $this->get_settings();
    
    $comment = comment::select_by_id($id);
    if($comment === NULL) {
      $this->not_found();
    }

    $this->meta->title = htmlentities($comment->title . ' - ' . $settings->site_name);
    $this->meta->author = htmlentities($settings->display_name);
    $this->meta->description = htmlentities($comment->snippet);
    if(!empty($comment->image_url)) {
      $this->meta->image = $comment->image_url;
    }
/*
    $comment_sectors = comment_sector::select_by_comment($comment->id);
    $sectors = array();
    foreach($comment_sectors as $comment_sector) {
      $sectors[] = $comment_sector->name;
    }
    $this->meta->keywords = htmlentities(implode(',', $sectors));
*/
    $this->view(array('comment' => $comment, 'sectors' => $sectors), 'index');
  }

  public function delete($id) {
    if($this->get_session() === NULL) {
      $this->redirect(NULL, 'home');
    }

    if(empty($id)) {
      $this->not_found();
    }
    
    $comment = comment::select_by_id($id);
    if($comment === NULL) {
      $this->not_found();
    }
    
    $model = array(
      'comment' => $comment, 
      'error' => NULL
    );

    if(array_key_exists('submit', $_POST)) {
      if(!$comment->delete()) {
        $model['error'] = 'Failed to delete comment: ' . last_error();
      }
      else {
        $this->redirect('search', 'comment');
      }
    }

    $this->meta->title = 'Delete Comment';
    $this->view($model);
  }

//todo: implement view....
  public function sector($sector = NULL, $page = 0) {
    if($sector === NULL) {
      $this->redirect(NULL, 'home');
    }
    
    $settings = $this->get_settings();
    $this->meta->title = 'comment sector ' . $sector . ' - ' .$settings->site_name;

    $page = intval($page);
    if($page < 0) {
      $page = 0;
    }
    
    $this->page = $page;
    $this->sector = $sector;
    $offset = $page * 25;

    $comments = comment::select_by_sector($sector, $offset);
    return $this->view(array('comments' => $comments, 'sectors' => array($sector)), 'index', 'home');
  }
}

?>