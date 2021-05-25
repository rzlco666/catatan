<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		include_once APPPATH . "../vendor/autoload.php";
		$google_client = new Google_Client();
		$google_client->setClientId('230172402617-7dureu6136ducb30hb0cdgjpidc0oiek.apps.googleusercontent.com'); //masukkan ClientID anda 
		$google_client->setClientSecret('WaQrjSgSi_K1wyCNzUtp4KB4'); //masukkan Client Secret Key anda
		$google_client->setRedirectUri('http://localhost/catatan/login'); //Masukkan Redirect Uri anda
		$google_client->addScope('email');
		$google_client->addScope('profile');

		if(isset($_GET["code"]))
		{
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
			if(!isset($token["error"]))
			{
				$google_client->setAccessToken($token['access_token']);
				$this->session->set_userdata('access_token', $token['access_token']);
				$google_service = new Google_Service_Oauth2($google_client);
				$data = $google_service->userinfo->get();
				$current_datetime = date('Y-m-d H:i:s');
				$user_data = array(
					'first_name' => $data['given_name'],
					'last_name'  => $data['family_name'],
					'email_address' => $data['email'],
					'profile_picture'=> $data['picture'],
					'updated_at' => $current_datetime
				);
				$email_data = $data['email'];
				$this->session->set_userdata('user_data', $data);
				$this->session->set_userdata('email', $email_data);
			}
		}

		$login_button = '';
		if(!$this->session->userdata('access_token'))
		{
			$login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="https://1.bp.blogspot.com/-gvncBD5VwqU/YEnYxS5Ht7I/AAAAAAAAAXU/fsSRah1rL9s3MXM1xv8V471cVOsQRJQlQCLcBGAsYHQ/s320/google_logo.png" /></a>';
			$data['login_button'] = $login_button;
			$this->load->view('login/google_login', $data);
		}
		else
		{
		  	// uncomentar kode dibawah untuk melihat data session email
		  	//echo json_encode($this->session->userdata('access_token')); 
		  	//echo json_encode($this->session->userdata('user_data'));
		  	redirect('notes');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('user_data');
		$this->session->unset_userdata('email');
		redirect('');
	}

}
