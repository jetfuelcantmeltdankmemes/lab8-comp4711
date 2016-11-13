<?php

class Admin extends Application {
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $origin = $_SERVER['HTTP_REFERER'];
        $role = $this->session->userdata('userrole');
        if ($role != 'admin') {
            $this->data['content'] = 'Access Denied';
            $this->render();
            return;
        }

        $this->data['pagebody' ] ='mtce';
        $this->data['items'] = $this->menu->all();
        $this->render();
    }
}