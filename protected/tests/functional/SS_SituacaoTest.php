<?php

class SS_SituacaoTest extends WebTestCase
{
	public $fixtures=array(
		'sS_Situacaos'=>'SS_Situacao',
	);

	public function testShow()
	{
		$this->open('?r=sS_Situacao/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=sS_Situacao/create');
	}

	public function testUpdate()
	{
		$this->open('?r=sS_Situacao/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=sS_Situacao/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=sS_Situacao/index');
	}

	public function testAdmin()
	{
		$this->open('?r=sS_Situacao/admin');
	}
}
