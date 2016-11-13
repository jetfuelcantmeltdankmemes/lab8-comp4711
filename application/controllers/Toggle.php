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
		$origin = $_SERVER['HTTP_REFERER'];
		$role = $this->session->userdata('userrole');
		if ($role == 'user') $role = 'admin';
		else $role = 'user';
		$this->session->set_userdata('userrole', $role);
		redirect($origin);
	}
        
        function edit($id=null) {
            // try the session first
            $key = $this->session->userdata('key');
            $record = $this->session->userdata('record');

            // if not there, get them from the database
            if (empty($key)) {
                    $record = $this->menu->get($id);
                    $key = $id;
                    $this->session->set_userdata('key',$id);
                    $this->session->set_userdata('record',$record);
            }

            // build the form fields
            $this->data['fid'] = makeTextField('Menu code', 'id', $record->id);
            $this->data['fname'] = makeTextField('Item name', 'name', $record->name);
            $this->data['fdescription'] = makeTextArea('Description', 'description', $record->description);
            $this->data['fprice'] = makeTextField('Price, each', 'price', $record->price);
            $this->data['fpicture'] = makeTextField('Item image', 'picture', $record->picture);
            
            // categories combobox
            $cats = $this->categories->all(); // get an array of category objects
            foreach($cats as $code => $category) // make it into an associative array
                $codes[$code] = $category->name;
            $this->data['fcategory'] = makeCombobox('Category', 'category', $record->category,$codes);

            $this->data['zsubmit'] = makeSubmitButton('Save', 'Submit changes');    // Submit btn
            
            // show the editing form
            $this->data['pagebody'] = "mtce-edit";
            $this->render();
        }
        
        function cancel() {
            $this->session->unset_userdata('key');
            $this->session->unset_userdata('record');
            $this->index();
        }
}
