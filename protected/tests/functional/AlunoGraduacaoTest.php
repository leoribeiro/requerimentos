<?php

class AlunoGraduacaoTest extends WebTestCase
{
	public $fixtures=array(
		'alunoGraduacaos'=>'AlunoGraduacao',
	);

	public function testShow()
	{
		$this->open('?r=alunoGraduacao/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=alunoGraduacao/create');
	}

	public function testUpdate()
	{
		$this->open('?r=alunoGraduacao/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=alunoGraduacao/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=alunoGraduacao/index');
	}

	public function testAdmin()
	{
		$this->open('?r=alunoGraduacao/admin');
	}
}
