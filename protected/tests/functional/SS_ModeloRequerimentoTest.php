<?php

class SS_ModeloRequerimentoTest extends WebTestCase
{
	public $fixtures=array(
		'sS_ModeloRequerimentos'=>'SS_ModeloRequerimento',
	);

	public function testShow()
	{
		$this->open('?r=sS_ModeloRequerimento/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=sS_ModeloRequerimento/create');
	}

	public function testUpdate()
	{
		$this->open('?r=sS_ModeloRequerimento/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=sS_ModeloRequerimento/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=sS_ModeloRequerimento/index');
	}

	public function testAdmin()
	{
		$this->open('?r=sS_ModeloRequerimento/admin');
	}
}
