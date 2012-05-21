<?php

class SS_ModeloRequerimentoController extends Controller
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
				'actions'=>array('create','update','AdicionaOpcao','RemoveOpcao','AdicionaOpcao2Versao','AdicionaOpcao2VersaoPDF','RemoveOpcao2Versao','RemoveOpcao2VersaoPDF'),
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
		$model=new SS_ModeloRequerimento;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	

		if(isset($_POST['SS_ModeloRequerimento']))
		{
			$model->attributes=$_POST['SS_ModeloRequerimento'];
			
			if(isset(Yii::app()->session['OpcoesEscolhidas'])){
				$model->relOpcao = Yii::app()->session['OpcoesEscolhidas'];
			}
			
			
			if($model->save()){
				
				$criteria = new CDbCriteria;
			    $criteria->compare('SS_Requerimento_CDRequerimento',
			    $model->CDModeloRequerimento);
			    $modelOpcaoModeloRequerimento = 
			    SS_OpcaoModeloRequerimento::model()->findAll($criteria);
			
				foreach($modelOpcaoModeloRequerimento as $modelSingle){
					if(isset($_POST['OpcaoEscPDF'.$modelSingle->SS_Opcao_CDOpcao])){
						$modelSingle->GerarRequerimentoImpresso = 1;
					}
					$modelSingle->save();
				}
				
				$this->redirect(array('view','id'=>$model->CDModeloRequerimento));
				
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['SS_ModeloRequerimento']))
		{
			$model->attributes=$_POST['SS_ModeloRequerimento'];
			
			if(isset(Yii::app()->session['OpcoesEscolhidas'])){
				$model->relOpcao = Yii::app()->session['OpcoesEscolhidas'];
			}
			
			if($model->save()){
				
				$criteria = new CDbCriteria;
			    $criteria->compare('SS_Requerimento_CDRequerimento',
			    $model->CDModeloRequerimento);
			    $modelOpcaoModeloRequerimento = 
			    SS_OpcaoModeloRequerimento::model()->findAll($criteria);
			
				foreach($modelOpcaoModeloRequerimento as $modelSingle){
					if(isset($_POST['OpcaoEscPDF'.$modelSingle->SS_Opcao_CDOpcao])){
						$modelSingle->GerarRequerimentoImpresso = 1;
					}
					$modelSingle->save();
				}
			
				$this->redirect(array('view','id'=>$model->CDModeloRequerimento));
			
			}
				
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('SS_ModeloRequerimento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SS_ModeloRequerimento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SS_ModeloRequerimento']))
			$model->attributes=$_GET['SS_ModeloRequerimento'];

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
				$this->_model=SS_ModeloRequerimento::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ss--modelo-requerimento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionAdicionaOpcao()
	{
		if(isset($_POST['OpcoesDisponiveis'])){
			$opcoes = $_POST['OpcoesDisponiveis'];
			
			// Não sei se é uma forma elegante, mas ainda não consegui resolver isto.
			// Usando uma variável de sessão para gravar as disciplinas escolhidas.
			if(!isset(Yii::app()->session['OpcoesEscolhidas'])){
				$OpcoesEscolhidas = array();	
			}
			else{
				$OpcoesEscolhidas = Yii::app()->session['OpcoesEscolhidas'];	
			}
			foreach($opcoes as $opcao){
				if(!in_array($opcao,$OpcoesEscolhidas))
					$OpcoesEscolhidas[] = $opcao;
			}	
			Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDOpcao', $OpcoesEscolhidas);
			$criteria->order = 'NMOpcao';
			$OpcoesBanco=SS_Opcao::model()->findAll($criteria);
		    $resultado=CHtml::listData($OpcoesBanco,'CDOpcao','NMOpcao');
		    $controleSelected = true;
		    foreach($resultado as $value=>$name)
		    {
				if($controleSelected){
					echo CHtml::tag('option',
			                   array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
				    $controleSelected = false;
				}
				else{
					echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
				}
		        
		    }
		

		}
	
	}
	
	
	public function actionAdicionaOpcao2Versao()
	{
		if(isset($_POST['OpcoesDisponiveis'])){
			$opcoes = $_POST['OpcoesDisponiveis'];
			
			// Não sei se é uma forma elegante, mas ainda não consegui resolver isto.
			// Usando uma variável de sessão para gravar as disciplinas escolhidas.
			if(!isset(Yii::app()->session['OpcoesEscolhidas'])){
				$OpcoesEscolhidas = array();	
			}
			else{
				$OpcoesEscolhidas = Yii::app()->session['OpcoesEscolhidas'];	
			}
			foreach($opcoes as $opcao){
				if(!in_array($opcao,$OpcoesEscolhidas))
					$OpcoesEscolhidas[] = $opcao;
			}	
			Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDOpcao', $OpcoesEscolhidas);
			$criteria->order = 'NMOpcao';
			$OpcoesBanco=SS_Opcao::model()->findAll($criteria);
		    $resultado=CHtml::listData($OpcoesBanco,'CDOpcao','NMOpcao');
		    
		    $x=1;
		    foreach($resultado as $value=>$name)
		    {
				if($x % 2){
					echo "<div style='background-color: #e5f1f4;'>";
					echo CHtml::Checkbox('OpcaoEsc'.$value). " ".$name;
					echo "</div>";
				}
				else{
					echo "<div>";
					echo CHtml::Checkbox('OpcaoEsc'.$value). " ".$name;
					echo "</div>";								
				}
				$x++;
		        
		    }
		

		}
	
	}
	
	public function actionAdicionaOpcao2VersaoPDF()
	{
		if(isset($_POST['OpcoesDisponiveis'])){
			$opcoes = $_POST['OpcoesDisponiveis'];
			
			// Não sei se é uma forma elegante, mas ainda não consegui resolver isto.
			// Usando uma variável de sessão para gravar as disciplinas escolhidas.
			if(!isset(Yii::app()->session['OpcoesEscolhidas'])){
				$OpcoesEscolhidas = array();	
			}
			else{
				$OpcoesEscolhidas = Yii::app()->session['OpcoesEscolhidas'];	
			}
			foreach($opcoes as $opcao){
				if(!in_array($opcao,$OpcoesEscolhidas))
					$OpcoesEscolhidas[] = $opcao;
			}	
			Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDOpcao', $OpcoesEscolhidas);
			$criteria->order = 'NMOpcao';
			$OpcoesBanco=SS_Opcao::model()->findAll($criteria);
		    $resultado=CHtml::listData($OpcoesBanco,'CDOpcao','NMOpcao');
		
		    
		    $x=1;
		    foreach($resultado as $value=>$name)
		    {
				if($x % 2){
					echo "<div style='background-color: #e5f1f4;'>";
				}
				else{
					echo "<div>";
				}
				if(isset($_POST['OpcaoEscPDF'.$value])){
					echo CHtml::Checkbox('OpcaoEscPDF'.$value,true). " Sim";	
				}
				else{
					echo CHtml::Checkbox('OpcaoEscPDF'.$value,false). " Sim";
				}
				echo "</div>";
				$x++; 
		    }
		

		}
	
	}
	
	public function actionRemoveOpcao()
	{
		if((isset($_POST['SS_ModeloRequerimento']['relOpcao'])) and (isset(Yii::app()->session['OpcoesEscolhidas']))){
			
			$opcoes = $_POST['SS_ModeloRequerimento']['relOpcao'];
			$OpcoesEscolhidas = Yii::app()->session['OpcoesEscolhidas'];
			
			$OpcoesEscolhidas = array_diff($OpcoesEscolhidas, $opcoes);
					
			Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDOpcao', $OpcoesEscolhidas);
			$criteria->order = 'NMOpcao';
			$OpcoesBanco=SS_Opcao::model()->findAll($criteria);
		    $resultado=CHtml::listData($OpcoesBanco,'CDOpcao','NMOpcao');
		    $controleSelected = true;
		    foreach($resultado as $value=>$name)
		    {
				if($controleSelected){
					echo CHtml::tag('option',
			                   array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
				    $controleSelected = false;
				}
				else{
					echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
				}
		        
		    }
		

		}
	
	}
	
	public function actionRemoveOpcao2Versao()
	{
			
		if((isset(Yii::app()->session['OpcoesEscolhidas']))){
			
			$opcoes = array();
			$tamanho = count(Yii::app()->session['OpcoesEscolhidas']);
			$OpcoesEsc = Yii::app()->session['OpcoesEscolhidas'];
			foreach($OpcoesEsc as $opcao){
				if(isset($_POST['OpcaoEsc'.$opcao])){
					$opcoes[] = $opcao;
				}
			}
			
			$OpcoesEscolhidas = Yii::app()->session['OpcoesEscolhidas'];
			
			$OpcoesEscolhidas = array_diff($OpcoesEscolhidas, $opcoes);
					
					
			Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDOpcao', $OpcoesEscolhidas);
			$criteria->order = 'NMOpcao';
			$OpcoesBanco=SS_Opcao::model()->findAll($criteria);
		    $resultado=CHtml::listData($OpcoesBanco,'CDOpcao','NMOpcao');


		    $x=1;
		    foreach($resultado as $value=>$name)
		    {
				if($x % 2){
					echo "<div style='background-color: #e5f1f4;'>";
					echo CHtml::Checkbox('OpcaoEsc'.$value). " ".$name;
					echo "</div>";
				}
				else{
					echo "<div>";
					echo CHtml::Checkbox('OpcaoEsc'.$value). " ".$name;
					echo "</div>";								
				}
				$x++;
		        
		    }

		}
	
	}
	
	public function actionRemoveOpcao2VersaoPDF()
	{
			
		if((isset(Yii::app()->session['OpcoesEscolhidas']))){
			
			$opcoes = array();
			$tamanho = count(Yii::app()->session['OpcoesEscolhidas']);
			$OpcoesEsc = Yii::app()->session['OpcoesEscolhidas'];
			foreach($OpcoesEsc as $opcao){
				if(isset($_POST['OpcaoEsc'.$opcao])){
					$opcoes[] = $opcao;
				}
			}
			
			$OpcoesEscolhidas = Yii::app()->session['OpcoesEscolhidas'];
			
			$OpcoesEscolhidas = array_diff($OpcoesEscolhidas, $opcoes);
					
					
			Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

			// Pesquisa nome das Disciplinas no Banco
			$criteria=new CDbCriteria;
			$criteria->addInCondition('CDOpcao', $OpcoesEscolhidas);
			$criteria->order = 'NMOpcao';
			$OpcoesBanco=SS_Opcao::model()->findAll($criteria);
		    $resultado=CHtml::listData($OpcoesBanco,'CDOpcao','NMOpcao');


		    $x=1;
		    foreach($resultado as $value=>$name)
		    {
				if($x % 2){
					echo "<div style='background-color: #e5f1f4;'>";
				}
				else{
					echo "<div>";
				}
				if(isset($_POST['OpcaoEscPDF'.$value])){
					echo CHtml::Checkbox('OpcaoEscPDF'.$value,true). " Sim";	
				}
				else{
					echo CHtml::Checkbox('OpcaoEscPDF'.$value,false). " Sim";
				}
				echo "</div>";
				$x++; 
		    }

		}
	
	}
	
	
	
}
