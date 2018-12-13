<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

		 public function __construct() {
			 parent::__construct();
			 $this->load->model('apimodel');
	 }

	public function index()
	{
		$error=[];
		try {
			$data=$this->apimodel->listData();
			$temp=array();
			if(count($data)>0)
			{
				foreach($data as $k=>$v)
				{
					$image=$this->apimodel->getImages($v['Property_owner_id']);
					$level=$this->apimodel->getLevel($v['Property_owner_id']);
					$temp[$k]['name']=$v['property_name'];
					$temp[$k]['address']=$v['property_address'];
					$temp[$k]['two_wheeler_charge']=$v['two_wheeler_charge'];
					$temp[$k]['four_wheeler_charge']=$v['four_wheeler_charge'];
					$temp[$k]['min_deposit']=$v['min_deposit'];
					$temp[$k]['images']=$image;
					$temp[$k]['level']=$level;
				}
				$data=array('status'=>'success','data'=>$temp);
			}
		} catch (\Exception $e) {
			$data=array('status'=>'error','data'=>'Some error occured. Please try again');
		}
		echo json_encode( $data );
		//exit;
	}
}
