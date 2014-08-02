<?php
date_default_timezone_set('UTC');
class Application {public static $DB_CONNECTION = NULL; }
function escape($sequence) {return mysqli_real_escape_string(Application::$DB_CONNECTION, $sequence);}
function last_error() {return mysqli_error(Application::$DB_CONNECTION);}

class ticket {
    public $id;
    public $title;
    public $image_url;
    public $published;
    public $snippet;
    public $body;
    public $created;
    public $updated;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->title = $row['title'];
        $this->image_url = $row['image_url'];
        $this->published = intval($row['published']);
        $this->snippet = $row['snippet'];
        $this->body = $row['body'];
        $this->created = $row['created'];
        $this->updated = $row['updated'];
    }

    public function insert() {
        $sql = 'insert into ticket (title, image_url, published, snippet, body, created) values ("%s", "%s", %d, "%s", "%s", UTC_TIMESTAMP())';
        $sql = sprintf($sql, escape($this->title), escape($this->image_url), $this->published, escape($this->snippet), escape($this->body));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update ticket set title = "%s", image_url = "%s", published = %d, snippet = "%s", body = "%s", updated = UTC_TIMESTAMP() where id = %d';
        $sql = sprintf($sql, escape($this->title), escape($this->image_url), $this->published, escape($this->snippet), escape($this->body), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from ticket where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_by_id($id) { 
        $sql = 'select id, title, image_url, published, snippet, body, created, updated from ticket where id=%d';
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
        $sql = 'select id, title, image_url, published, snippet, body, created, updated from ticket where published = 1 order by id desc limit %d, 25';
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
        $sql = 'select id, title, image_url, published, null as snippet, null as body, created, updated from ticket order by id desc';
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

    public static function select_by_tag($tag, $offset = 0) { 
        $sql = 'select id, title, image_url, published, snippet, null as body, created, updated from ticket e inner join (select ticket from ticket_tag et inner join tag t on et.tag = t.id where name = "%s" group by ticket) t on e.id = t.ticket where published = 1 order by id desc limit %d, 25';
        $sql = sprintf($sql, escape($tag), $offset);
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
}

class session {
    public $id;
    public $code;
    public $created;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->code = $row['code'];
        $this->created = $row['created'];
    }

    public function insert() {
        $sql = 'insert into session (code, created) values ("%s", UTC_TIMESTAMP())';
        $sql = sprintf($sql, escape($this->code), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public static function select_by_id($id) { 
        $sql = 'select id, code, created from session where id=%d';
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
        $sql = 'select id, code, created from session where code="%s"';
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
    public $blog_name;
    public $email;
    public $display_name;
    public $password_hash;
    public $password_salt;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->blog_name = $row['blog_name'];
        $this->email = $row['email'];
        $this->display_name = $row['display_name'];
        $this->password_hash = $row['password_hash'];
        $this->password_salt = $row['password_salt'];
    }

    public function insert() {
        $sql = 'insert into setting (blog_name, email, display_name, password_hash, password_salt) values ("%s", "%s", "%s", "%s", "%s")';
        $sql = sprintf($sql, escape($this->blog_name), escape($this->email), escape($this->display_name), escape($this->password_hash), escape($this->password_salt));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update setting set blog_name = "%s", email = "%s", display_name = "%s", password_hash = "%s", password_salt = "%s" where id = %d';
        $sql = sprintf($sql, escape($this->blog_name), escape($this->email), escape($this->display_name), escape($this->password_hash), escape($this->password_salt), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from setting where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_first() { 
        $sql = 'select id, blog_name, email, display_name, password_hash, password_salt from setting limit 0, 1';
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $setting = new setting();
        $setting->load(mysqli_fetch_array($res));
        return $setting;
    }
}

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

    public static function select_accounts() { 
        $sql = 'select id, email, display_name, password_hash, password_salt from account limit 0, 1';
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return NULL;
        }
        $account = new account();
        $account->load(mysqli_fetch_array($res));
        return $account;
    }
}


class tag {
    public $id;
    public $name;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->name = $row['name'];
    }

    public static function find_or_create($name) {
        $sql = 'select id, name from tag where name = "%s"';
        $sql = sprintf($sql, escape($name));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE) {
            return FALSE;
        }
        
        $tag = new tag();
        if(mysqli_num_rows($res) === 0) {
            $sql = 'insert into tag (name) values ("%s");';
            $sql = sprintf($sql, escape($name));
            $res = mysqli_query(Application::$DB_CONNECTION, $sql);
            if($res === FALSE) {
                return FALSE;
            }
            $tag->id = mysqli_insert_id(Application::$DB_CONNECTION);
            $tag->name = $name;
        }
        else {
            $tag->load(mysqli_fetch_array($res));
        }
        return $tag;
    }
}

class ticket_tag {
    public $ticket;
    public $tag;
    public $name;

    public function load($row) {
        $this->ticket = intval($row['ticket']);
        $this->tag = intval($row['tag']);
        $this->name = array_key_exists('name', $row) ? $row['name'] : NULL;
    }

    public function insert() {
        $sql = 'insert into ticket_tag (ticket, tag) values (%d, %d)';
        $sql = sprintf($sql, $this->ticket, $this->tag);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public static function select_by_ticket($ticket) {
        $sql = 'select ticket, tag, name from ticket_tag et inner join tag t on et.tag = t.id where ticket = "%s"';
        $sql = sprintf($sql, $ticket);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE || mysqli_num_rows($res) === 0) { 
            return array();
        }
        $array = array();
        while($row = mysqli_fetch_array($res)) {
            $ticket = new ticket_tag();
            $ticket->load($row);
            $array[] = $ticket;
        }
        return $array;
    }
    
    public static function delete_by_ticket($ticket) {
        $sql = 'delete from ticket_tag where ticket = %d';
        $sql = sprintf($sql, $ticket);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }
}

class tags_in_use {
    public static function select_all() {
        $res = mysqli_query(Application::$DB_CONNECTION, 'select name from tag t inner join (select tag, count(*) as das_count from ticket_tag group by tag) c on t.id = c.tag and das_count > 0 order by das_count desc, name asc');
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