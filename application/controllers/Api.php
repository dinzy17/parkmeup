<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

		 public function __construct() {
			 parent::__construct();
			 $this->load->model('apimodel');
	 }

	public function index()
	{
		$requestData = $this->input->raw_input_stream;
		$request = (array)json_decode($requestData);
		$service=$request['service'];
		switch($service){
			case "list":
						$this->listData();
						break;
			case 'book':
						$this->book($request);
						break;
			default:
							echo 'hi';
		}

		//exit;
	}
	public function listData(){

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
							if(count($image)>0)
							{
								$temp[$k]['images']=$image;
							}else{
								$temp[$k]['images']= array('/images/no-image.jpg');
							}
							$temp[$k]['level']=$level;
						}
						$data=array('status'=>'success','data'=>$temp);
					}
				} catch (\Exception $e) {
					$data=array('status'=>'error','data'=>'Some error occured. Please try again');
				}
				echo json_encode( $data );
	}
	public function cancel(){
		$data=$this->apimodel->cancel();
	}
	public function book($request){
		$data=$this->apimodel->book($request);
		if($data=='inserted')
		{
			$data=array('status'=>'success','data'=>'Some error occured. Please try again');
		}else{
			$data=array('status'=>'error','data'=>'Some error occured. Please try again');
		}
		echo json_encode( $data );
	}
}
