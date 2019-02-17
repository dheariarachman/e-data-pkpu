<?php 
	$this->load->view('layouts/header');
	$this->load->view('layouts/content', array('content' => $content));
	$this->load->view('layouts/footer');
?>