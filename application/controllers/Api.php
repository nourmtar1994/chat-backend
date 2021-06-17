<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Authorization_Token');
    }


    public function register_post()
    {

        $token_data['user_id'] = 121;
        $token_data['fullname'] = "nour";
        $token_data['email'] = "dj_nour@live.fr";
        $token = $this->authorization_token->generateToken($token_data);

        $final = array();
        $final['token'] = $token;
        $final['status'] = "ok";
        $this->response($final);
    }

    public function verify_post()
    {
        $headers = $this->input->request_headers();
        $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

        $this->response($decodedToken);
    }
    public function user_get()
    {
        $array  = array('status' => 'ok', 'data' => 1);
        $this->response($array);
    }
}