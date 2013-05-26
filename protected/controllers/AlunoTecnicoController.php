<?php

class AlunoTecnicoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$permU = 'false';
		if(isset($_GET["id"])){
			$modelA = $this->loadModel();
		if(Yii::app()->user->checkAccess('servidor'))
			$permU = 'true';
		else if(Yii::app()->user->checkAccess('admin'))
			$permU = 'true';
		else if(Yii::app()->user->getState('CDUsuario') == $modelA->Aluno_CDAluno)
			$permU = 'true';
		}
		$permUA = 'false';
		if(Yii::app()->user->checkAccess('servidor'))
			$permUA = 'true';
		else if(Yii::app()->user->checkAccess('admin'))
			$permUA = 'true';

		return array(

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('allow',
                'actions'=>array('update','view'),
                'expression'=>$permU,
            ),
            array('allow',
                'actions'=>array('admin','view','update'),
                'expression'=>$permUA,
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$tab = 'tab1';
		$firstAluno = false;

		if(empty($_POST['Aluno']['CDAluno'])){
			$modelAluno=new Aluno;
		}
		else{
			$criteria = new CDbCriteria;
			$criteria->compare('CDAluno',$_POST['Aluno']['CDAluno']);
			$modelAluno = Aluno::model()->find($criteria);
		}

		$model=new AlunoTecnico;

		if(isset($_GET['matricula'])){
			$modelAluno->NMAluno = ucwords(strtolower($_GET['nomecompleto']));
			$modelAluno->Email = $_GET['email'];
			$modelAluno->NumMatricula = $_GET['matricula'];

			Yii::app()->user->setFlash('success', 'É a primeira vez que você entra no sistema. <br />É necessário atualizar seus dados.');
			$firstAluno = true;
		}

		if(isset($_POST['Aluno']))
		{
			$modelAluno->attributes=$_POST['Aluno'];

			// deveria ser um método, mas o tempo não tá ajudando...
			if(isset($_POST['Aluno']['Telefone'])){
				$pontos = array("-", "(",")"," ");
				$_POST['Aluno']['Telefone'] = str_replace($pontos, "", $_POST['Aluno']['Telefone']);
				$modelAluno->Telefone=$_POST['Aluno']['Telefone'];
			}
			else {
				$modelAluno->Telefone = '';
			}

			if($modelAluno->save()){
				$model->Aluno_CDAluno = $modelAluno->CDAluno;
				$this->render('create',array(
					'modelAluno'=>$modelAluno,
					'modelAlunoTecnico'=>$model,
					'tab'=>'tab2',
				));
				Yii::app()->end();
			}
		}
		else if(isset($_POST['AlunoTecnico']))
		{
			$model->attributes=$_POST['AlunoTecnico'];
			if($model->save()){

				if($firstAluno){

					$criteria = new CDbCriteria;
					$criteria->compare('CDAluno',$model->Aluno_CDAluno);
					$modelAluno = Aluno::model()->find($criteria);
					Yii::app()->user->setState('CDUsuario', $model->Aluno_CDAluno);
					Yii::app()->user->removeState('novoaluno');

					$this->redirect(array('//aluno/view',
					'id'=>$modelAluno->CDAluno,'saveSuccess'=>true));
					Yii::app()->end();

				}

				$this->redirect(array('admin'));
				Yii::app()->end();
			}
			$tab = 'tab2';

		}

		$this->render('create',array(
			'modelAluno'=>$modelAluno,
			'modelAlunoTecnico'=>$model,
			'tab'=>$tab,
			'firstAluno'=>$firstAluno,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

			$tab = 'tab1';

			$criteria = new CDbCriteria;
			$criteria->compare('CDAluno',$model->Aluno_CDAluno);
			$modelAluno = Aluno::model()->find($criteria);

			if(isset($_POST['Aluno']))
			{
				$modelAluno->attributes=$_POST['Aluno'];

				// deveria ser um método, mas o tempo não tá ajudando...
				if(isset($_POST['Aluno']['Telefone'])){
					$pontos = array("-", "(",")"," ");
					$_POST['Aluno']['Telefone'] = str_replace($pontos, "", $_POST['Aluno']['Telefone']);
					$modelAluno->Telefone=$_POST['Aluno']['Telefone'];
				}
				else {
					$modelAluno->Telefone = '';
				}

				if($modelAluno->save()){
					$model->Aluno_CDAluno = $modelAluno->CDAluno;
					$this->render('update',array(
						'modelAluno'=>$modelAluno,
						'modelAlunoTecnico'=>$model,
						'tab'=>'tab2',
					));
					Yii::app()->end();
				}
			}
			else if(isset($_POST['AlunoTecnico']))
			{
				$model->attributes=$_POST['AlunoTecnico'];
				if($model->save()){

					if(Yii::app()->user->checkAccess('aluno')){
						$this->redirect(array('//aluno/view','id'=>$modelAluno->CDAluno,'saveSuccess'=>true));
						Yii::app()->end();
					}

					$this->redirect(array('admin'));
					Yii::app()->end();
				}
				$tab = 'tab2';

			}

			$this->render('update',array(
				'modelAluno'=>$modelAluno,
				'modelAlunoTecnico'=>$model,
				'tab'=>$tab,
			));

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AlunoTecnico');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AlunoTecnico('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AlunoTecnico']))
			$model->attributes=$_GET['AlunoTecnico'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=AlunoTecnico::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='aluno-tecnico-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
