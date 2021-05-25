<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Notes_model");
    }
    public function index()
    {
        $notes=  $this->Notes_model->get_notes();
        $data['notes']=$notes;
        $this->load->view('note/notes',$data);
    }

    public function insert_note(){
        $data=array(
            "title"=>  $this->input->post("title"),
            "text"=>$this->input->post("text"),
            "email"=>$this->session->userdata('email')
        );
        $data["date_created"]=date("Y-m-d H:i:s");
        $id=$this->Crud_model->insert("notes",$data);
        $response['result']="success";
        $response['id']=$id;
        echo json_encode($response);
    }

    public function update_note(){
      $id= $this->input->post("id");
        $data=array(
            "title"=>  $this->input->post("title"),
            "text"=>$this->input->post("text"),
            "email"=>$this->session->userdata('email')
        );
        $id=$this->Crud_model->update("notes",$id,$data);
        $response['result']="success";
        echo json_encode($response);
    }

    public function get_notes(){
      $notes=  $this->Notes_model->get_notes();
      $response['result']="success";
      $response['notes']=$notes;
      echo json_encode($response);
    }

    public function search(){
      $search= strtolower($this->input->post("search"));
      $notes=$this->Notes_model->filter_notes($search);
      $response['result']="success";
      $response['notes']=$notes;
      echo json_encode($response);
    }

    public function delete_note(){
      $id= $this->input->post("id");
      $this->Crud_model->delete("notes",$id);
      $response['result']="success";
      echo json_encode($response);
      // redirect(base_url("Notes"));
    }

}