<?php

class sectorController extends Controller {
  protected $page;
  protected $sector;

  public function index($sector = NULL, $page = 0) {
    if($sector === NULL) {
      $this->redirect(NULL, 'home');
    }
    
    $settings = $this->get_settings();
    $this->meta->title = 'tickets sectorged ' . $sector . ' - ' .$settings->blog_name;

    $page = intval($page);
    if($page < 0) {
      $page = 0;
    }
    
    $this->page = $page;
    $this->sector = $sector;
    $offset = $page * 25;

    $tickets = ticket::select_by_sector($sector, $offset);
    return $this->view(array('tickets' => $tickets, 'sectors' => array($sector)), 'index', 'home');
  }
}

?>