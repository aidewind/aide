<?php
date_default_timezone_set('UTC');
class Application {public static $DB_CONNECTION = NULL; }
function escape($sequence) {return mysqli_real_escape_string(Application::$DB_CONNECTION, $sequence);}
function last_error() {return mysqli_error(Application::$DB_CONNECTION);}

class ticket {
    public $id;
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
        $sql = 'insert into ticket (body, created) values ("%s", UTC_TIMESTAMP())';
        $sql = sprintf($sql, escape($this->body));
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
    public $site_name;
    public $email;
    public $display_name;
    public $password_hash;
    public $password_salt;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->site_name = $row['site_name'];
        $this->email = $row['email'];
        $this->display_name = $row['display_name'];
        $this->password_hash = $row['password_hash'];
        $this->password_salt = $row['password_salt'];
    }

    public function insert() {
        $sql = 'insert into setting (site_name, email, display_name, password_hash, password_salt) values ("%s", "%s", "%s", "%s", "%s")';
        $sql = sprintf($sql, escape($this->site_name), escape($this->email), escape($this->display_name), escape($this->password_hash), escape($this->password_salt));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public function update() {
        $sql = 'update setting set site_name = "%s", email = "%s", display_name = "%s", password_hash = "%s", password_salt = "%s" where id = %d';
        $sql = sprintf($sql, escape($this->site_name), escape($this->email), escape($this->display_name), escape($this->password_hash), escape($this->password_salt), $this->id);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        return $res;
    }

    public function delete() {
        $sql = 'delete from setting where id = %d';
        $sql = sprintf($sql, $this->id);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
    }

    public static function select_first() { 
        $sql = 'select id, site_name, email, display_name, password_hash, password_salt from setting limit 0, 1';
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

    public static function select_by_email($email) { 
        $sql = 'select id, email, display_name, password_hash, password_salt from account where email = %s';
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


class sector {
    public $id;
    public $name;

    public function load($row) {
        $this->id = intval($row['id']);
        $this->name = $row['name'];
    }

    public static function find_or_create($name) {
        $sql = 'select id, name from sector where name = "%s"';
        $sql = sprintf($sql, escape($name));
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        if($res === FALSE) {
            return FALSE;
        }
        
        $sector = new sector();
        if(mysqli_num_rows($res) === 0) {
            $sql = 'insert into sector (name) values ("%s");';
            $sql = sprintf($sql, escape($name));
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
}

class ticket_sector {
    public $ticket;
    public $sector;
    public $name;

    public function load($row) {
        $this->ticket = intval($row['ticket']);
        $this->sector = intval($row['sector']);
        $this->name = array_key_exists('name', $row) ? $row['name'] : NULL;
    }

    public function insert() {
        $sql = 'insert into ticket_sector (ticket, sector) values (%d, %d)';
        $sql = sprintf($sql, $this->ticket, $this->sector);
        $res = mysqli_query(Application::$DB_CONNECTION, $sql);
        $this->id = mysqli_insert_id(Application::$DB_CONNECTION);
        return $res;
    }

    public static function select_by_ticket($ticket) {
        $sql = 'select ticket, sector, name from ticket_sector et inner join sector t on et.sector = t.id where ticket = "%s"';
        $sql = sprintf($sql, $ticket);
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
    
    public static function delete_by_ticket($ticket) {
        $sql = 'delete from ticket_sector where ticket = %d';
        $sql = sprintf($sql, $ticket);
        return mysqli_query(Application::$DB_CONNECTION, $sql);
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