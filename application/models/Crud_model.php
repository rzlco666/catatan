<?php

class Crud_model extends CI_Model{
    
    public function insert($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    public function update($table,$id,$data){
        $this->db->where("id",$id);
        $this->db->update($table,$data);
    }
    public function delete($table,$id){
        $this->db->where("id",$id);
        $this->db->delete($table);
    }
    public function get_one($table,$id){
        $this->db->where("id",$id);
        return $this->db->get($table)->row();
    }
    public function get_all($table){
        return $this->db->get($table)->result();
    }
    public function get_all_active($table){
        $this->db->where("deleted !=",1);
        return $this->db->get($table)->result();
    }
}
