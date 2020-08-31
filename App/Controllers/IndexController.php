<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function registro() {
        
		$this->view->usuario = array(
				'userid' => '',
				'name' => '',
				'email' => '',
				'password' => '',
				'confirmpassword' => ''
			);

		$this->view->erroCadastro = false;

		$this->render('registro');
	}

	public function registrar(){
	
		// receber dados 
		$usuario = Container::getModel('Usuario');
		$usuario->__set('userid', $_POST['userid']);
		$usuario->__set('name', $_POST['name']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('password', $_POST['password']);
		$usuario->__set('confirmpassword', $_POST['confirmpassword']);

		// sucesso
		if($usuario->validate() && count($usuario->getUsuarioPorUserID()) == 0){
			
		$usuario->save();

		$this->render('cadastro');

		} else {

		$this->view->usuario = array(
				'userid' => $_POST['userid'],
				'name' => $_POST['name'],
				'email' => $_POST['email'],
				'password' => $_POST['password'],
				'confirmpassword' => $_POST['confirmpassword']
			);

		$this->view->erroCadastro = true;

		$this->render('registro');

		}
		
	}

}


?>