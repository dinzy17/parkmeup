<?php
class Property extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('PropertyModel');
        $this->load->helper('url');
    }
    
    public function index() {
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('pname', 'Location Name', 'required');
        $this->form_validation->set_rules('address', 'Property Address', 'required');
        
        $this->form_validation->set_rules('two_wheeler_charge', '2 Wheeler Charge', 
            'required|greater_than[0]|less_than[10000]',
            array(
            'required'      => 'The 2 Wheeler Charge field is required.',
            'greater_than'  => 'The 2 Wheeler Charge must be greater than 0.',
            'less_than'     => 'The 2 Wheeler Charge must be less than 10000.'
            )
        );
        $this->form_validation->set_rules('four_wheeler_charge', '4 Wheeler Charge',
            'required|greater_than[0]|less_than[10000]',
            array(
                'required'      => 'The 4 Wheeler Charge field is required.',
                'greater_than'  => 'The 4 Wheeler Charge must be greater than 0.',
                'less_than'     => 'The 4 Wheeler Charge must be less than 10000.'
            )
        );
        $this->form_validation->set_rules('mindeposit', 'Minimum Deposit',
            'required|greater_than[0]|less_than[10000]',
            array(
                'required'      => 'The Minimum Deposit field is required.',
                'greater_than'  => 'The Minimum Deposit must be greater than 0.',
                'less_than'     => 'The Minimum Deposit must be less than 10000.'
            )
        );
        
        $this->form_validation->set_rules('level[]', 'Level', 'required',
            array(
                'required' => 'You must provide Level name for all rows.',
            )
        );
        
        $this->form_validation->set_rules('twcapacity[]', 'Level', 'required',
            array(
                'required' => 'You must provide 2 Wheeler Capacity for all rows.',
            )
        );
        
        $this->form_validation->set_rules('fourwcapacity[]', 'Level', 'required',
            array(
                'required' => 'You must provide 4 Wheeler Capacity for all rows.',
            )
        );
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('fillpropertyDetails');
        }
        else
        {
            $addStatus = $this->PropertyModel->addpropertyDetails($_POST);
			if($addStatus){ 
				$this->load->view('success.php');
			}
        }
        
       // $this->load->view('fillpropertyDetails.php');
    }
    
}