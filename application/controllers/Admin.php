<?php

class Admin extends Application {
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $origin = $_SERVER['HTTP_REFERER'];
        $role = $this->session->userdata('userrole');
        if ($role == 'user') {
            $this->data['content'] = 'Access Denied';
        } else {
            $this->data['content'] = 'Welcome to the Admin Control Panel';
        };
        $this->render();
    }
}