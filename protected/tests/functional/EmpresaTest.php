<?php

class EmpresaTest extends WebTestCase
{
	public $fixtures=array(
		'empresas'=>'Empresa',
	);

	public function testShow()
	{
		$this->open('?r=empresa/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=empresa/create');
	}

	public function testUpdate()
	{
		$this->open('?r=empresa/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=empresa/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=empresa/index');
	}

	public function testAdmin()
	{
		$this->open('?r=empresa/admin');
	}
}
