<?php
date_default_timezone_set('UTC');
class Application {public static $DB_CONNECTION = NULL; }
function escape($sequence) {return mysqli_real_escape_string(Application::$DB_CONNECTION, $sequence);}
function last_error() {return mysqli_error(Application::$DB_CONNECTION);}

/*
 * entities
 */

class account {
    public $id;
    public $email;
    public $display_name;
    public $password_hash;
    public $password_salt;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->email = $row['email'];
        $this->display_name = $row['display_name'];
        $this->password_hash = $row['password_hash'];
        $this->password_salt = $row['password_salt'];
    }

    public function insert() {
        $sql = 'insert into account (email, display_name, password_hash, password_salt) values ("%s", "%s", "%s", "%s")';
        $sql = sprintf($sql, escape($this->email), escape($this->display_name), escape($this->password_hash), escape($this->password_salt));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update account set email = "%s", display_name = "%s", password_hash = "%s", password_salt = "%s" where id = %d';
        $sql = sprintf($sql, escape($this->email), escape($this->display_name), escape($this->password_hash), escape($this->password_salt), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from account where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_by_email($email) { 
        $sql = 'select id, email, display_name, password_hash, password_salt from account where email = "%s"';
        $sql = sprintf($sql, escape($email));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $account = new account();
        $account->load(mysqli_fetch_array($res));
        return $account;
    }
}

class comment {
  public $id;
  public $body;
  public $created;
  public $updated;
  public $account;
  public $ticket;

  public function load($row) {
    $this->id = intval($row['id']);
    $this->body = $row['body'];
    $this->created = $row['created'];
    $this->updated = $row['updated'];
    $this->account = $row['account'];
    $this->ticket = $row['ticket'];
  }


  public function insert() {
      $sql = 'insert into comment (body, created, account, ticket) values ("%s", UTC_TIMESTAMP(), "%s", "%s")';
      $sql = sprintf($sql, escape($this->body), escape($this->account), escape($this->ticket));
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
      return $res;
  }

  public function update() {
      $sql = 'update comment set body = "%s", updated = UTC_TIMESTAMP() where id = %d';
      $sql = sprintf($sql, escape($this->body), $this->id);
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      return $res;
  }

  public function delete() {
      $sql = 'delete from comment where id = %d';
      $sql = sprintf($sql, $this->id);
      return mysqli_query(Application::$DB_CONNECTION, $sql);
  }

  public static function select_by_ticket($ticket) {
      $sql = 'select id, body, created, updated, account, ticket from comment where ticket = "%s" order by id desc';
      $sql = sprintf($sql, $ticket);
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      if($res === FALSE || mysqli_num_rows($res) === 0) { 
          return array();
      }
      $array = array();
      while($row = mysqli_fetch_array($res)) {
          $comment = new comment();
          $comment->load($row);
          $array[] = $comment;
      }
      return $array;
  }

  public static function select_by_id($id) { 
    $sql = 'select id, body, created, updated, account, ticket from comment where id=%d';
    $sql = sprintf($sql, $id);
    $res = mysqli_query(Application::$DB_CONNECTION, $sql);
    if($res === FALSE || mysqli_num_rows($res) === 0) { 
        return NULL;
    }
    $comment = new comment();
    $comment->load(mysqli_fetch_array($res));
    return $comment;
  }

}

class member {
    public $id;
    public $email;
    public $complete_name;
    protected $word;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->email = $row['email'];
        $this->complete_name = $row['complete_name'];
    }

    public function find_or_create() {
        $sql = 'select id, email, complete_name from member where email = "%s"';
        $sql = sprintf($sql, escape($this->email));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE) {
            return FALSE;
        }
        
        $member = new member();
        if(mysqli_num_rows($res) === 0) {
            $sql = 'insert into member (email, complete_name) values ("%s", "%s");';
            $sql = sprintf($sql, escape($this->email), escape($this->complete_name));
            $res = mysqli_query(Application::$DB_CONNECTION, $sql);
            if($res === FALSE) {
                return FALSE;
            }
            $member->id = mysqli_insert_id(Application::$DB_CONNECTION);
        } else {
            $member->load(mysqli_fetch_array($res));
        }
        return $member;
    }

    public function insert() {
        $sql = 'insert into member (email, complete_name) values ("%s", "%s")';
        $sql = sprintf($sql, escape($this->email), escape($this->complete_name));

        echo $sql;
        stop();

        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update member set email = "%s", complete_name = "%s" where id = %d';
        $sql = sprintf($sql, escape($this->email), escape($this->complete_name), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from member where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_by_id($id) { 
        $sql = 'select id, email, complete_name from member where id=%d';
        $sql = sprintf($sql, $id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $member = new member();
        $member->load(mysqli_fetch_array($res));
        return $member;
    }

    public static function select_by_word($word) { 
        $sql = 'select id, email, complete_name from member where (CONVERT(email USING utf8) LIKE "%%%s%%" OR CONVERT(complete_name USING utf8) LIKE "%%%s%%")';
        $sql = sprintf($sql, escape($word), escape($word));

        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        
        $members = array();
        for($i=0;$i<mysqli_num_rows($res);$i++) {
          $member = new member();
          $member->load(mysqli_fetch_array($res));
          $members[] = $member;
          unset($member);
        }

        return $members;
    }

    public static function select_by_email($email) { 
        $sql = 'select id, email, complete_name from member where email = "%s"';
        $sql = sprintf($sql, escape($email));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $member = new member();
        $member->load(mysqli_fetch_array($res));
        return $member;
    }

    public static function select_list() {
        $sql = 'select id, email, complete_name from member order by id desc';
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return array();
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $ticket = new member();
            $ticket->load($row);
            $array[] = $ticket;
        }
        return $array;
    }
}

class sector {
    public $id;
    public $name;
    public $email;
    public $initial;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->initial = $row['initial'];
    }

    public static function find_or_create($name) {
        $sql = 'select id, name, email from sector where name = "%s"';
        $sql = sprintf($sql, escape($name));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE) {
            return FALSE;
        }
        
        $sector = new sector();
        if(mysqli_num_rows($res) === 0) {
            $sql = 'insert into sector (name, email) values ("%s", "%s");';
            $sql = sprintf($sql, escape($name), escape($email));
            $res = mysqli_query(Application::$DB_CONNECTION, $sql);
            if($res === FALSE) {
                return FALSE;
            }
            $sector->id = mysqli_insert_id(Application::$DB_CONNECTION);
            $sector->name = $name;
        }
        else {
            $sector->load(mysqli_fetch_array($res));
        }
        return $sector;
    }

    public function insert() {
        $sql = 'insert into sector (name, email, initial) values ("%s", "%s", "%s")';
        $sql = sprintf($sql, escape($this->name), escape($this->email), escape($this->initial));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update sector set name = "%s", email = "%s", initial = "%s" where id = %d';
        $sql = sprintf($sql, escape($this->name), escape($this->email), escape($this->initial), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from sector where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_by_id($id) { 
        $sql = 'select id, name, email, initial from sector where id=%d';
        $sql = sprintf($sql, $id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $sector = new sector();
        $sector->load(mysqli_fetch_array($res));
        return $sector;
    }

    public static function select_by_word($word) { 
        $sql = 'select id, name from sector where (CONVERT(name USING utf8) LIKE "%%%s%%")';
        $sql = sprintf($sql, escape($word));

        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        
        $sectors = array();
        for($i=0;$i<mysqli_num_rows($res);$i++) {
          $sector = new sector();
          $sector->load(mysqli_fetch_array($res));
          $sectors[] = $sector;
          unset($sector);
        }

        return $sectors;
    }

    public static function select_list() {
        $sql = 'select id, name from sector order by name asc';
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);        
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return array();
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $sector = new sector();
            $sector->load($row);
            $array[] = $sector;
        }
        return $array;
    }
}

class session {
    public $id;
    public $code;
    public $created;
    public $account;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->code = $row['code'];
        $this->created = $row['created'];
        $this->account = $row['account'];
    }

    public function insert() {
        $sql = 'insert into session (code, created, account) values ("%s", UTC_TIMESTAMP(), "%d")';
        $sql = sprintf($sql, escape($this->code), escape($this->account), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public static function select_by_id($id) { 
        $sql = 'select id, code, created, account from session where id=%d';
        $sql = sprintf($sql, $id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $session = new session();
        $session->load(mysqli_fetch_array($res));
        return $session;
    }

    public static function select_by_code($code) { 
        $sql = 'select id, code, created, account from session where code="%s"';
        $sql = sprintf($sql, escape($code));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $session = new session();
        $session->load(mysqli_fetch_array($res));
        return $session;
    }
}

class setting {
    public $id;
    public $site_name;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->site_name = $row['site_name'];
    }

    public function insert() {
        $sql = 'insert into setting (site_name) values ("%s")';
        $sql = sprintf($sql, escape($this->site_name));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update setting set site_name = "%s" where id = %d';
        $sql = sprintf($sql, escape($this->site_name), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from setting where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_first() { 
        $sql = 'select id, site_name from setting limit 0, 1';
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $setting = new setting();
        $setting->load(mysqli_fetch_array($res));
        return $setting;
    }
}

class ticket {
    public $id;
    public $body;
    public $created;
    public $updated;
    public $account;

    public function load($row) {
        $this->id = intval($row['id']);
        //$this->title = $row['title'];
        //$this->image_url = $row['image_url'];
        //$this->published = intval($row['published']);
        //$this->snippet = $row['snippet'];
        $this->body = $row['body'];
        $this->created = $row['created'];
        $this->updated = $row['updated'];
        $this->account = $row['account'];
    }

    public function insert() {
        $sql = 'insert into ticket (body, created,account) values ("%s", UTC_TIMESTAMP(),"%s")';
        $sql = sprintf($sql, escape($this->body), escape($this->account));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update ticket set body = "%s", updated = UTC_TIMESTAMP() where id = %d';
        $sql = sprintf($sql, escape($this->body), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from ticket where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_by_id($id) { 
        $sql = 'select id, body, created, updated from ticket where id=%d';
        $sql = sprintf($sql, $id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $ticket = new ticket();
        $ticket->load(mysqli_fetch_array($res));
        return $ticket;
    }

    public static function select($offset = 0) { 
        $sql = 'select id, body, created, updated from ticket order by id desc limit %d, 25';
        $sql = sprintf($sql, $offset);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return array();
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $ticket = new ticket();
            $ticket->load($row);
            $array[] = $ticket;
        }
        return $array;
    }
    
    public static function select_list() {
        $sql = 'select id, body, created, updated from ticket order by id desc';
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return array();
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $ticket = new ticket();
            $ticket->load($row);
            $array[] = $ticket;
        }
        return $array;
    }

    public static function select_by_sector($sector, $offset = 0) { 
        $sql = 'select id, body, created, updated from ticket e inner join (select ticket from ticket_sector et inner join sector t on et.sector = t.id where name = "%s" group by ticket) t on e.id = t.ticket order by id desc limit %d, 25';
        $sql = sprintf($sql, escape($sector), $offset);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return array();
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $ticket = new ticket();
            $ticket->load($row);
            $array[] = $ticket;
        }
        return $array;
    }

    public static function select_by_word($word) { 
        $sql = 'select id, body, created, updated from ticket where (CONVERT(body USING utf8) LIKE "%%%s%%")';
        $sql = sprintf($sql, escape($word));

        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        
        $tickets = array();
        for($i=0;$i<mysqli_num_rows($res);$i++) {
          $ticket = new ticket();
          $ticket->load(mysqli_fetch_array($res));
          $tickets[] = $ticket;
          unset($ticket);
        }

        return $tickets;
    }
}

/*
 * relations
 */

class sector_closure {
  public $ancestor;
  public $descendant;

  public function select_descendants_of($id) {
    $sql = 'select name from sector s join sector_closure sc on (s.id = sc.descendant) where sc.ancestor = "%s"';
    $sql = sprintf($sql, $id);

    $res = mysqli_query(Application::$DB_CONNECTION, $sql);
    if($res === FALSE || mysqli_num_rows($res) === 0) { 
        return array();
    }
    $array = array();
    while($row = mysqli_fetch_array($res)) {
        $ticket = new ticket_sector();
        $ticket->load($row);
        $array[] = $ticket;
    }
    return $array;
  }
}

class sector_member {
  public $member;
  public $sector;

  public function insert() {
      $sql = 'insert into sector_member (member, sector) values ("%s", "%s")';
      $sql = sprintf($sql, escape($this->member), escape($this->sector));

      echo $sql;
      stop();

      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
      return $res;
  }

}

class ticket_member {
  public $id;
  public $member;
  public $created;
  public $updated;
  public $account;
  public $ticket;

  public function load($row) {
    $this->id = intval($row['id']);
    $this->member = $row['member'];
    $this->created = $row['created'];
    $this->updated = $row['updated'];
    $this->account = $row['account'];
    $this->ticket = $row['ticket'];
  }


  public function insert() {
      $sql = 'insert into ticket_member (member, created, account, ticket) values ("%s", UTC_TIMESTAMP(), "%s", "%s")';
      $sql = sprintf($sql, escape($this->member), escape($this->account), escape($this->ticket));
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
      return $res;
  }

  public function update() {
      $sql = 'update ticket_member set member = "%s", updated = UTC_TIMESTAMP() where id = %d';
      $sql = sprintf($sql, escape($this->member), $this->id);
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      return $res;
  }

  public function delete() {
      $sql = 'delete from ticket_member where id = %d';
      $sql = sprintf($sql, $this->id);
      return mysqli_query(Application::$DB_CONNECTION, $sql);
  }

  public static function select_by_ticket($ticket) {
      $sql = 'select id, member, created, updated, account, ticket from ticket_member where ticket = "%s" order by id desc';
      $sql = sprintf($sql, $ticket);
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      if($res === FALSE || mysqli_num_rows($res) === 0) { 
          return array();
      }
      $array = array();
      while($row = mysqli_fetch_array($res)) {
          $ticket_member = new ticket_member();
          $ticket_member->load($row);
          $array[] = $ticket_member;
      }
      return $array;
  }

  public static function select_by_id($id) { 
    $sql = 'select id, member, created, updated, account, ticket from ticket_member where id=%d';
    $sql = sprintf($sql, $id);
    $res = mysqli_query(Application::$DB_CONNECTION, $sql);
    if($res === FALSE || mysqli_num_rows($res) === 0) { 
        return NULL;
    }
    $ticket_member = new ticket_member();
    $ticket_member->load(mysqli_fetch_array($res));
    return $ticket_member;
  }

}

class ticket_sector {
  public $id;
  public $sector;
  public $created;
  public $updated;
  public $account;
  public $ticket;

  public function load($row) {
    $this->id = intval($row['id']);
    $this->sector = $row['sector'];
    $this->created = $row['created'];
    $this->updated = $row['updated'];
    $this->account = $row['account'];
    $this->ticket = $row['ticket'];
  }


  public function insert() {
      $sql = 'insert into ticket_sector (sector, created, account, ticket) values ("%s", UTC_TIMESTAMP(), "%s", "%s")';
      $sql = sprintf($sql, escape($this->sector), escape($this->account), escape($this->ticket));
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
      return $res;
  }

  public function update() {
      $sql = 'update ticket_sector set sector = "%s", updated = UTC_TIMESTAMP() where id = %d';
      $sql = sprintf($sql, escape($this->sector), $this->id);
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      return $res;
  }

  public function delete() {
      $sql = 'delete from ticket_sector where id = %d';
      $sql = sprintf($sql, $this->id);
      return mysqli_query(Application::$DB_CONNECTION, $sql);
  }

  public static function select_by_ticket($ticket) {
      $sql = 'select id, sector, created, updated, account, ticket from ticket_sector where ticket = "%s" order by id desc';
      $sql = sprintf($sql, $ticket);
      $res = mysqli_query(Application::$DB_CONNECTION, $sql);
      if($res === FALSE || mysqli_num_rows($res) === 0) { 
          return array();
      }
      $array = array();
      while($row = mysqli_fetch_array($res)) {
          $ticket_sector = new ticket_sector();
          $ticket_sector->load($row);
          $array[] = $ticket_sector;
      }
      return $array;
  }

  public static function select_by_id($id) { 
    $sql = 'select id, sector, created, updated, account, ticket from ticket_sector where id=%d';
    $sql = sprintf($sql, $id);
    $res = mysqli_query(Application::$DB_CONNECTION, $sql);
    if($res === FALSE || mysqli_num_rows($res) === 0) { 
        return NULL;
    }
    $ticket_sector = new ticket_sector();
    $ticket_sector->load(mysqli_fetch_array($res));
    return $ticket_sector;
  }

}


class sectors_in_use {
    public static function select_all() {
        $res = mysqli_query(Application::$DB_CONNECTION, 'select name from sector t inner join (select sector, count(*) as das_count from ticket_sector group by sector) c on t.id = c.sector and das_count > 0 order by das_count desc, name asc');
        if($res === FALSE) {
            return FALSE;
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $array[] = $row['name'];
        }
        return $array;
    }
}



Application::$DB_CONNECTION = mysqli_connect(
    Configuration::get_instance()->db->host,
    Configuration::get_instance()->db->username,
    Configuration::get_instance()->db->password,
    Configuration::get_instance()->db->database
);

?>