<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Toggle
 *
 * @author j
 */
class Toggle extends Application {
    
	public function index()	{
		$role = $this->session->userdata('userrole');
		if ($role == 'user') $role = 'admin';
		else $role = 'user';
		$this->session->set_userdata('userrole', $role);
		redirect($origin);
	}
}
