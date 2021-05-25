<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes_model extends CI_Model {
    function get_notes(){
        $email = $this->session->userdata('email');
        $this->db->where('email', $email);
        $this->db->order_by("date_created","desc");
        $this->db->from("notes");
        $query=$this->db->get();
        return $query->result();
    }

    function filter_notes($search){
      $this->db->like("LOWER(title)",$search);
      $this->db->or_like("LOWER(text)",$search);
      $query= $this->db->get("notes");
      return $query->result();
    }
}
