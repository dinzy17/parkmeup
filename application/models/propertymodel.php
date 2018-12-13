<?php

class PropertyModel extends CI_Model {
   function __construct() {
        parent::__construct();
    }
    function addpropertyDetails($arr){
        $data = array(
            'property_name'	=>  $arr['pname'],
            'property_address' =>  $arr['address'],
            'two_wheeler_charge'	=>  $arr['two_wheeler_charge'],
            'four_wheeler_charge'	=>  $arr['four_wheeler_charge'],
            'min_deposit'	=>  $arr['mindeposit'],
        );
        $this->db->insert('tbl_property_owner', $data);
        $insertid=$this->db->insert_id();
        $fileData='';
        $imageNameArr=array();
        $imageArray = array();
        if(!empty($_FILES['images']['name'])){
           $filesCount = count($_FILES['images']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $file_name = $_FILES['images']['name'][$i];
                $file_size = $_FILES['images']['size'][$i];
                $file_tmp  = $_FILES['images']['tmp_name'][$i];
                $t = explode(".", $file_name);
                $prefix=$t[0];
                $t1 = end($t);
                $file_ext = strtolower(end($t));
                $imagePrefix =  time();
                $imageName=$prefix.$imagePrefix.".".$file_ext;
                $imageNameArr[$i]=$imageName;
                
                $ext_boleh = array("jpg", "jpeg", "png", "gif", "bmp");
                if(in_array($file_ext, $ext_boleh)) {
                    $sumber = $file_tmp;
                    $tujuan = "uploads/images/" . $imageName;
                    move_uploaded_file($sumber, $tujuan);
                }
              }
        } 
        for($x = 0; $x < count($arr['level']); $x++){
            $updateArray[] = array(
                'property_id'=>$insertid,
                'level_no'=>$arr['level'][$x],
                'two_wheeler_capacity' =>$arr['twcapacity'][$x],
                'four_wheeler_capacity' => $arr['fourwcapacity'][$x]
                
            );
            if(isset($imageNameArr[$x])){
                 $imageArray[]=array(
                    'property_id'	=>  $insertid,
                    'property_image'	=>  $imageNameArr[$x],
                    
                );
            }
        }
        $this->db->insert_batch('tbl_property_level', $updateArray);
        if($imageArray!=null){
            $this->db->insert_batch('tbl_property_images', $imageArray);
        }
        return  $insertid;
    }
}
