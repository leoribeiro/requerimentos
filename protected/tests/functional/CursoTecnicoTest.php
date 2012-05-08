<?php

class CursoTecnicoTest extends WebTestCase
{
	public $fixtures=array(
		'cursoTecnicos'=>'CursoTecnico',
	);

	public function testShow()
	{
		$this->open('?r=cursoTecnico/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cursoTecnico/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cursoTecnico/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cursoTecnico/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cursoTecnico/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cursoTecnico/admin');
	}
}
