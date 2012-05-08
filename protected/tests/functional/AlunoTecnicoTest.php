<?php

class AlunoTecnicoTest extends WebTestCase
{
	public $fixtures=array(
		'alunoTecnicos'=>'AlunoTecnico',
	);

	public function testShow()
	{
		$this->open('?r=alunoTecnico/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=alunoTecnico/create');
	}

	public function testUpdate()
	{
		$this->open('?r=alunoTecnico/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=alunoTecnico/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=alunoTecnico/index');
	}

	public function testAdmin()
	{
		$this->open('?r=alunoTecnico/admin');
	}
}
