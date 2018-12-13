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
}
