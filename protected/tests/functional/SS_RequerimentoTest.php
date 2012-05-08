<?php

class SS_RequerimentoTest extends WebTestCase
{
	public $fixtures=array(
		'sS_Requerimentos'=>'SS_Requerimento',
	);

	public function testShow()
	{
		$this->open('?r=sS_Requerimento/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=sS_Requerimento/create');
	}

	public function testUpdate()
	{
		$this->open('?r=sS_Requerimento/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=sS_Requerimento/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=sS_Requerimento/index');
	}

	public function testAdmin()
	{
		$this->open('?r=sS_Requerimento/admin');
	}
}
