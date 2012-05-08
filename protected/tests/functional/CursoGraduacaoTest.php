<?php

class CursoGraduacaoTest extends WebTestCase
{
	public $fixtures=array(
		'cursoGraduacaos'=>'CursoGraduacao',
	);

	public function testShow()
	{
		$this->open('?r=cursoGraduacao/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cursoGraduacao/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cursoGraduacao/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cursoGraduacao/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cursoGraduacao/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cursoGraduacao/admin');
	}
}
