<?php

class AlunoGraduacaoController extends Controller
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
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
		
		$model=new AlunoGraduacao;
		
		if(isset($_GET['matricula'])){
			$modelAluno->NMAluno = ucwords(strtolower($_GET['nomecompleto']));
			$modelAluno->Email = $_GET['email'];
			$modelAluno->NumMatricula = $_GET['matricula'];
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
					'modelAlunoGraduacao'=>$model,
					'tab'=>'tab2',
					'firstAluno'=>$firstAluno,
				));
				Yii::app()->end();
			}
		}
		else if(isset($_POST['AlunoGraduacao']))
		{
			$model->attributes=$_POST['AlunoGraduacao'];
			if($model->save()){
				if($firstAluno){
					
					$criteria = new CDbCriteria;
					$criteria->compare('CDAluno',$model->Aluno_CDAluno);
					$modelAluno = Aluno::model()->find($criteria);
					
					Yii::app()->user->setModelAluno($modelAluno);
					
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
			'modelAlunoGraduacao'=>$model,
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

		//validação não está boa, temos que implementar aquela extensão Rights
		if(is_null(Yii::app()->user->getModelAluno()) or (Yii::app()->user->getModelAluno()->CDAluno == $model->Aluno_CDAluno)){

			$tab = 'tab1';
			$firstAluno = false;
		
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
						'modelAlunoGraduacao'=>$model,
						'tab'=>'tab2',
					));
					Yii::app()->end();
				}
			}
			else if(isset($_POST['AlunoGraduacao']))
			{
				$model->attributes=$_POST['AlunoGraduacao'];
				if($model->save()){
				
					if(Yii::app()->user->getTipoAluno() == 2){
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
				'modelAlunoGraduacao'=>$model,
				'tab'=>$tab,
				'firstAluno'=>$firstAluno,
			));
		
	}
	else{
		throw new CHttpException(400,'Infelizmente existe algo errado.');
	}
	
	
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
		$dataProvider=new CActiveDataProvider('AlunoGraduacao');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{	
		$model=new AlunoGraduacao('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AlunoGraduacao']))
			$model->attributes=$_GET['AlunoGraduacao'];

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
				$this->_model=AlunoGraduacao::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='aluno-graduacao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
