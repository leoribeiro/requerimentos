<?php

class RequerimentosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $siglaReqRegistroEscolar;
	public $siglaReqTecnico;
	public $siglaReqGraduacao;
	public $siglaReqEstagio;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	public function getSiglaReqRegistroEscolar(){
		$this->siglaReqRegistroEscolar = SS_RequerimentoAlunoRegistroEscolar::model()->SgReq;
		return $this->siglaReqRegistroEscolar;
	}

	public function getSiglaReqTecnico(){
		$this->siglaReqTecnico = SS_RequerimentoAlunoTecnico::model()->SgReq;
		return $this->siglaReqTecnico;
	}

	public function getSiglaReqGraduacao(){
		$this->siglaReqGraduacao = SS_RequerimentoAlunoGraduacao::model()->SgReq;
		return $this->siglaReqGraduacao;
	}

	public function getSiglaReqEstagio(){
		$this->siglaReqEstagio = SS_RequerimentoAlunoEstagio::model()->SgReq;
		return $this->siglaReqEstagio;
	}

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
				'actions'=>array('create','update','admin','Estatisticas'),
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
		if(isset($_GET['alterarSituacao']))
			$alterarSituacao = true;
		else
			$alterarSituacao = false;
		
		$modelRequerimento = $this->loadModel();
		$CDRequerimento = $modelRequerimento->CDRequerimento;
		
	   $criteria = new CDbCriteria;
	   $criteria->with = array('relRequerimento');
	   $criteria->together = true;
	   $criteria->compare('relRequerimento.CDRequerimento',$CDRequerimento);
	   $model = SS_RequerimentoAlunoRegistroEscolar::model()->find($criteria);
	   if(is_null($model)){
		   $model = SS_RequerimentoAlunoTecnico::model()->find($criteria);
		   if(is_null($model)){
			 $model = SS_RequerimentoAlunoGraduacao::model()->find($criteria);
			 if(is_null($model)){
				 $model = SS_RequerimentoAlunoEstagio::model()->find($criteria);
			   }
		   }	
	   }        
	   $modelSituacaoRequerimento = new SS_SituacaoRequerimento;
	   $modelSituacaoRequerimento->SS_Requerimento_CDRequerimento =
	   $modelRequerimento->CDRequerimento;
	
	   $numRequerimento = $model->getNumRequerimento();
	
		if(isset($_POST['SS_SituacaoRequerimento']))
		{
			
			$modelSituacaoRequerimento->attributes = $_POST['SS_SituacaoRequerimento'];
			
			if($modelSituacaoRequerimento->save()){
				$alterarSituacao = false;
				$this->render('view',array(
					'modelRequerimento'=>$modelRequerimento,'numRequerimento'=>$numRequerimento,'model'=>$model,'alterarSituacao'=>$alterarSituacao,'saveSuccess'=>true,'modelSituacaoRequerimento'=>$modelSituacaoRequerimento,
				));
				Yii::app()->end();
			}
		}
	
	   
		
		$this->render('view',array(
			'modelRequerimento'=>$modelRequerimento,'numRequerimento'=>$numRequerimento,'model'=>$model,'alterarSituacao'=>$alterarSituacao,'saveSuccess'=>false,'modelSituacaoRequerimento'=>$modelSituacaoRequerimento,
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
			case $this->getSiglaReqRegistroEscolar():
				$model=new SS_RequerimentoAlunoRegistroEscolar;
				$model->CDRequerimentoAlunoRegistroEscolar = 	SS_RequerimentoAlunoRegistroEscolar::model()->getLastRecord()+1;
				
				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',1);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case $this->getSiglaReqTecnico():
				$model=new SS_RequerimentoAlunoTecnico;
				$model->CDRequerimentoAlunoTecnico = 	SS_RequerimentoAlunoTecnico::model()->getLastRecord()+1;
				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',2);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case $this->getSiglaReqGraduacao():
				$model=new SS_RequerimentoAlunoGraduacao;
				$model->CDRequerimentoAlunoGraduacao = 	SS_RequerimentoAlunoGraduacao::model()->getLastRecord()+1;

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',3);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case $this->getSiglaReqEstagio():
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
		$criteria->compare('CDAluno',Yii::app()->user->getModelAluno()->CDAluno);
		$modelAluno = Aluno::model()->find($criteria);

		// informa qual será o requerimento
		$modelRequerimento->SS_ModeloRequerimento_CDModeloRequerimento = $modelModeloRequerimento->CDModeloRequerimento;
		// define aluno que está requerendo o requerimento
		$modelRequerimento->Aluno_CDAluno = $modelAluno->CDAluno;

		$criteria = new CDbCriteria;	$criteria->compare('Aluno_CDAluno',Yii::app()->user->getModelAluno()->CDAluno);
		$modelAlunoTecnico  = AlunoTecnico::model()->find($criteria);
		
		$criteria = new CDbCriteria;
	$criteria->compare('Aluno_CDAluno',Yii::app()->user->getModelAluno()->CDAluno);
		$modelAlunoGraduacao = AlunoGraduacao::model()->find($criteria);

		if(isset($_POST['SS_Requerimento']))
		{
			$modelRequerimento->attributes = $_POST['SS_Requerimento'];
			$modelRequerimento->relOpcao = $_POST['SS_Requerimento']['relOpcao'];

			// Coloca a situação do requerimento como Enviado
			$modelRequerimento->relSituacao = array(1);
			
			if($modelRequerimento->save()){
				
				$idReq = 0;
				$opcoesPDF = array();
				foreach($modelRequerimento->relOpcao as $req){
					$criteria = new CDbCriteria;
					$criteria->compare('SS_Opcao_CDOpcao',$req);
					$modelOMR = SS_OpcaoModeloRequerimento::model()->find($criteria);
					if($modelOMR->GerarRequerimentoImpresso == 1){
						$idReq = 1;
						break;
					}
				}
				
				if($idReq != 0){
					$idReq = $modelRequerimento->CDRequerimento;
				}
				
				$model->SS_Requerimento_CDRequerimento = $modelRequerimento->CDRequerimento;
				$model->Ano = date("Y");
				if($model->save()){
					$this->redirect(array('admin','Req'=>$form,
					'saveSuccess'=>true,'idReq'=>$idReq));
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
			case $this->siglaReqRegistroEscolar:
				$num = SS_RequerimentoAlunoRegistroEscolar::model()->getLastRecord();
				break;
			case $this->siglaReqTecnico:
				$num = SS_RequerimentoAlunoTecnico::model()->getLastRecord();
				break;	
			case $this->siglaReqGraduacao:
				$num = SS_RequerimentoAlunoGraduacao::model()->getLastRecord();
				break;
			case $this->siglaReqEstagio:
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
		
		$opcaoRequerimento = $_GET['Req'];

		
		switch($opcaoRequerimento){
				case $this->getSiglaReqRegistroEscolar():
					$tipoReq = 1;
					$model=new SS_RequerimentoAlunoRegistroEscolar('search');
					break;
				case $this->getSiglaReqTecnico():
					$tipoReq = 2;
					$model=new SS_RequerimentoAlunoTecnico('search');
					break;	
				case $this->getSiglaReqGraduacao():
					$tipoReq = 3;
					$model=new SS_RequerimentoAlunoGraduacao('search');
					break;
				case $this->getSiglaReqEstagio():
					$tipoReq = 4;
					$model=new SS_RequerimentoAlunoEstagio('search');
					break;		
			}
			
			// Define o modelo de requerimento
			$criteria = new CDbCriteria;
			$criteria->compare('CDModeloRequerimento',$tipoReq);
			$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
			
			

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SS_Requerimento']))
			$model->attributes=$_GET['SS_Requerimento'];

		$this->render('//controleRequerimentos/admin',array(
			'model'=>$model,'modelModeloRequerimento'=>$modelModeloRequerimento
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
				$this->_model=SS_Requerimento::model()->findbyPk($_GET['id']);
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
