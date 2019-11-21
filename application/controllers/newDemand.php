<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;

class newDemand extends CI_Controller{

	public function index(){
		$this->load->helper(array('url','form'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nom_utilisateur', 'Utilisateur', 'required');
		$this->form_validation->set_rules('titre_demande', 'Titre', 'required');
		$this->form_validation->set_rules('description_demande', 'Description', 'required');
		$this->form_validation->set_rules('budget_demande', 'Budget', 'required');
		$data['header']=$this->load->view('header', NULL, TRUE);
		$data['nav']=$this->load->view('nav', NULL, TRUE);
		$data['footer']=$this->load->view('footer', NULL, TRUE);

		if ($this->form_validation->run() == FALSE)
		{
			$demand['valid']=false;
			$data['page']=$this->load->view('newDemand', $demand, TRUE);
			$this->load->view('template',$data);
		}
		else
		{
			$this->action($this->input->post());
			$demand['valid']=true;
			$data['page']=$this->load->view('newDemand', $demand, TRUE);
			$this->load->view('template',$data);
		}
	}
	public function action($data_post){

		$api_url = "http://api.demo:8080/insert";

		/*$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($client, CURLOPT_HEADER, false);
		curl_setopt($client, CURLOPT_POST, count($data_post));
		curl_setopt($client, CURLOPT_POSTFIELDS, $data_post);

		$response = curl_exec($client);
		if(!$response){die("Connection Failure");}
		curl_close($client);

		echo $response;*/
		$client = new \GuzzleHttp\Client();
		$reponse = $client->request('POST', 'http://api.demo:8080/insert', $data_post);
		echo $reponse->getStatusCode();
	}

}
