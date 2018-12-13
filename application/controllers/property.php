<?php
class property extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('PropertyModel');
    }
    
    public function index() {
        
       $this->load->view('fillpropertyDetails.php');
    }
}