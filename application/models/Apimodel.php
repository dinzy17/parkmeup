<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Apimodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listData() {
      $query=$this->db->query("select * from tbl_property_owner");
      return $query->result_array();
    }
    function getImages($propid)
    {
      $query=$this->db->query("select * from tbl_property_images where property_id=".$propid);
      return $query->result_array();
    }
    function getLevel($propid)
    {
      $query=$this->db->query("select * from tbl_property_level where property_id=".$propid);
      return $query->result_array();
    }
    function cancel($request)
    {
      $query=$this->db->query("update booking_slot set status=0 where id=".$request['data']->bookid);
      return 'updated';
    }
    function book($request)
    {
      $query=$this->db->query("select * from tbl_property_owner where Property_owner_id=".$request['data']->prop_id);
      $data=$query->result_array();
      $query=$this->db->query("insert into booking_slot (property_id, udid,  vehicle_type, level, status,created) values ('".$request['data']->prop_id."'
        ,'".$request['data']->udid."','".$request['data']->vehicle_type."','".$request['data']->level."',1,'".date('Y-m-d H:i:s')."'
      ) ");

      $this->load->library('phpqrcode/qrlib');
  		$this->load->helper('url');
  		//echo $_SERVER['HTTP_HOST'];die;
  		 $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/git/parkmeup/images/barcode/';
  			$text = 'Name: '.$data[0]['property_name'].', vehicle type: '.$request['data']->vehicle_type.' Wheeler, Floor: '.$request['data']->level;
  			$text1= substr('book', 0,9);

  			$folder = $SERVERFILEPATH;
  			$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
  			$file_name = $folder.$file_name1;
  			QRcode::png($text,$file_name);
        $temp=array('status'=>'inserted','barcodeimage'=>base_url().'images/barcode/'.$file_name1);
        return $temp;
      //return $query->result_array();
    }
}
