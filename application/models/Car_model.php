<?php
 class Car_model extends CI_model{
     public function create($formArray)
     {
     $this->db->insert('car_models',$formArray);
     return $id = $this->db->insert_id();
     }
     //This method will records from car_models table
    public function all(){
      $result= $this->db
               ->order_by('id','ASC')
               ->get('car_models')
               ->result_array();
               //SELLECT * FROM car_models orderby id ASC
               return $result; 
    }
    function getRow($id){
      $this->db->where('id',$id);
      $row = $this->db->get('car_models')->row_array();
      return $row;
    }
 }
 ?> 