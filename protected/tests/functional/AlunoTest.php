<?php

class AlunoTest extends WebTestCase
{
	public $fixtures=array(
		'alunos'=>'Aluno',
	);

	public function testShow()
	{
		$this->open('?r=aluno/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=aluno/create');
	}

	public function testUpdate()
	{
		$this->open('?r=aluno/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=aluno/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=aluno/index');
	}

	public function testAdmin()
	{
		$this->open('?r=aluno/admin');
	}
}
