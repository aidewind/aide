<?php

class HomeController extends Controller {
  protected $page;

  public function index($page = 0) {
    $settings = $this->get_settings();
    $this->meta->title = $settings->site_name;

    $page = intval($page);
    if($page < 0) {
      $page = 0;
    }
    $this->page = $page;
    $offset = $page * 25;

    $tickets = ticket::select($offset);
    $sectors = sectors_in_use::select_all();
    return $this->view(array('tickets' => $tickets, 'sectors' => $sectors));
  }
}

?>