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
			case 'cancel':
						$this->cancel($request);
						break;
			default:
							echo 'hi';
		}

		//exit;
	}
	public function listData(){

				$error=[];
				try {
					if($_SERVER['HTTP_HOST']=='localhost')
					{
						$url='http://localhost/git/parkmeup/';
					}else{
						$url='http://ec2-52-72-13-211.compute-1.amazonaws.com/app/';
					}
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
								$temp[$k]['images']= array($_SERVER['HTTP_HOST'].'/images/no-image.jpg');
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

	public function cancel($request){
		$data=$this->apimodel->cancel($request);
		if($data=='updated')
		{
			$data=array('status'=>'success','message'=>'Booking Cancelled Successfully');
		}else{
			$data=array('status'=>'error','data'=>'Some error occured. Please try again');
		}
		echo json_encode( $data );
	}

	public function book($request){
		$data=$this->apimodel->book($request);
		if($data['status']=='inserted')
		{
			$data=array('status'=>'success','barccode'=>$data['barcodeimage']);
		}else{
			$data=array('status'=>'error','data'=>'Some error occured. Please try again');
		}
		echo json_encode( $data );
	}
	public function barcode()
	{
		$this->load->library('phpqrcode/qrlib');
		$this->load->helper('url');
		//echo $_SERVER['HTTP_HOST'];die;
		$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/git/parkmeup/images/barcode/';
			$text = 'aaaa';
			$text1= substr($text, 0,9);

			$folder = $SERVERFILEPATH;
			$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
			$file_name = $folder.$file_name1;
			QRcode::png($text,$file_name);

			echo"<center><img src=".base_url().'images/barcode/'.$file_name1."></center>";die;
	}
}
