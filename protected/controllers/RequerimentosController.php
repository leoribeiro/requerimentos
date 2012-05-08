<?php

class RequerimentosController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$modelRequerimento=new SS_Requerimento;
		$form = $_GET['form'];
		switch($form){
			case "RR":
				$model=new SS_RequerimentoAlunoRegistroEscolar;
				$model->CDRequerimentoAlunoRegistroEscolar = 	SS_RequerimentoAlunoRegistroEscolar::model()->getLastRecord()+1;
				
				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',1);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case "RAT":
				$model=new SS_RequerimentoAlunoTecnico;
				$model->CDRequerimentoAlunoTecnico = 	SS_RequerimentoAlunoTecnico::model()->getLastRecord()+1;
				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',2);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case "RAG":
				$model=new SS_RequerimentoAlunoGraduacao;
				$model->CDRequerimentoAlunoGraduacao = 	SS_RequerimentoAlunoGraduacao::model()->getLastRecord()+1;

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',3);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case "RET":
				$model=new SS_RequerimentoAlunoEstagio;
				$model->CDRequerimentoAlunoEstagio = 	SS_RequerimentoAlunoEstagio::model()->getLastRecord()+1;

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',4);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
				
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$criteria = new CDbCriteria;
		$criteria->compare('CDAluno',2);
		$modelAluno = Aluno::model()->find($criteria);

		// informa qual será o requerimento
		$modelRequerimento->SS_ModeloRequerimento_CDModeloRequerimento = $modelModeloRequerimento->CDModeloRequerimento;
		// define aluno que está requerendo o requerimento
		$modelRequerimento->Aluno_CDAluno = $modelAluno->CDAluno;

		$modelAlunoTecnico = null;
		
		$criteria = new CDbCriteria;
		$criteria->compare('Aluno_CDAluno',2);
		$modelAlunoGraduacao = AlunoGraduacao::model()->find($criteria);

		if(isset($_POST['SS_Requerimento']))
		{
			$modelRequerimento->attributes = $_POST['SS_Requerimento'];
			$modelRequerimento->relOpcao = $_POST['SS_Requerimento']['relOpcao'];
			if($modelRequerimento->save()){
				$model->SS_Requerimento_CDRequerimento = $modelRequerimento->CDRequerimento;
				$model->Ano = date("Y");
				if($model->save()){
					$this->redirect(array('view','id'=>$model->CDRequerimentoAlunoRegistroEscolar));
				}
						
			}
			
			
		}
		
		$numRequerimento = $this->NumRequerimento($form);
		
		$this->render('//requerimentos/create',array(
			'model'=>$model,'modelAluno'=>$modelAluno,'modelAlunoGraduacao'=>$modelAlunoGraduacao,'modelAlunoTecnico'=>$modelAlunoTecnico,'modelRequerimento'=>$modelRequerimento,'modelModeloRequerimento'=>$modelModeloRequerimento,'numRequerimento'=>$numRequerimento
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SS_Requerimento']))
		{
			$model->attributes=$_POST['SS_Requerimento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CDRequerimento));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	private function NumRequerimento($form)
	{
		switch($form){
			case "RR":
				$num = SS_RequerimentoAlunoRegistroEscolar::model()->getLastRecord();
				break;
			case "RAT":
				$num = SS_RequerimentoAlunoTecnico::model()->getLastRecord();
				break;	
			case "RAG":
				$num = SS_RequerimentoAlunoGraduacao::model()->getLastRecord();
				break;
			case "RET":
				$num = SS_RequerimentoAlunoEstagio::model()->getLastRecord();
				break;		
		}
		$num++;
		return ($form . str_pad($num, 4, "0", STR_PAD_LEFT) . "/" . date("Y"));
		
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
		$dataProvider=new CActiveDataProvider('SS_Requerimento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SS_Requerimento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SS_Requerimento']))
			$model->attributes=$_GET['SS_Requerimento'];

		$this->render('requerimentos/create',array(
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
				$this->_model=SS_RequerimentoAlunoRegistroEscolar::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ss--requerimento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
