<?php

class SS_OpcaoTest extends WebTestCase
{
	public $fixtures=array(
		'sS_Opcaos'=>'SS_Opcao',
	);

	public function testShow()
	{
		$this->open('?r=sS_Opcao/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=sS_Opcao/create');
	}

	public function testUpdate()
	{
		$this->open('?r=sS_Opcao/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=sS_Opcao/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=sS_Opcao/index');
	}

	public function testAdmin()
	{
		$this->open('?r=sS_Opcao/admin');
	}
}
