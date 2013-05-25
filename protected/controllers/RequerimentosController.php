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
	public $siglaReqTecnicoFG;
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

	public function getSiglaReqTecnicoFG(){
		$this->siglaReqTecnicoFG = SS_RequerimentoAlunoTecnicoFG::model()->SgReq;
		return $this->siglaReqTecnicoFG;
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
		$permU = 'false';
		if(isset($_GET["id"])){
			$modelRequerimento = $this->loadModel();
		if(Yii::app()->user->checkAccess('servidor'))
			$permU = 'true';
		else if(Yii::app()->user->checkAccess('admin'))
			$permU = 'true';
		else if(Yii::app()->user->CDUsuario == $modelRequerimento->Aluno_CDAluno)
			$permU = 'true';
		}
		$permUA = 'false';
		if(Yii::app()->user->checkAccess('servidor'))
			$permUA = 'true';
		else if(Yii::app()->user->checkAccess('admin'))
			$permUA = 'true';

		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','Estatisticas','view','SegundaChamada','CartaEstagio'),
				'users'=>array('@'),
			),
			array('allow',
                'actions'=>array('view'),
                'expression'=>$permU,
            ),
            array('allow',
                'actions'=>array('admin'),
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
		$urlPerm = $this->createUrl('admin',array('Req'=>'RR'));
		if(isset($_GET['urlReq'])){
			$urlPerm = $this->createUrl('admin',array('Req'=>$_GET['urlReq']));
		}

		$modelRequerimento = $this->loadModel();

		if(isset($_GET['alterarSituacao']) &&
		(Yii::app()->user->checkAccess('servidor') || Yii::app()->user->checkAccess('admin')))
			$alterarSituacao = true;
		else
			$alterarSituacao = false;

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
				if(is_null($model)){
					 $model = SS_RequerimentoAlunoTecnicoFG::model()->find($criteria);
				   }
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
			if(Yii::app()->user->checkAccess('servidor')){
				$Responsavel = Yii::app()->user->CDUsuario;
			}
			else{
				$Responsavel = null;
			}
			$modelSituacaoRequerimento->CDServidorResponsavel = $Responsavel;

			if($modelSituacaoRequerimento->save()){
				$alterarSituacao = false;

				$obs = '';
				$this->enviaEmail($model,
				$modelSituacaoRequerimento->SS_Situacao_CDSituacao,$obs);

				$this->render('view',array(
					'modelRequerimento'=>$modelRequerimento,'numRequerimento'=>$numRequerimento,'model'=>$model,'alterarSituacao'=>$alterarSituacao,'saveSuccess'=>true,'modelSituacaoRequerimento'=>$modelSituacaoRequerimento,'urlReq'=>$urlPerm
				));
				Yii::app()->end();
			}
		}

		$this->render('view',array(
			'modelRequerimento'=>$modelRequerimento,'numRequerimento'=>$numRequerimento,'model'=>$model,'alterarSituacao'=>$alterarSituacao,'saveSuccess'=>false,'modelSituacaoRequerimento'=>$modelSituacaoRequerimento,'urlReq'=>$urlPerm
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	// É necessário refatorar todo esse Controller, principalmente
	// este método. Isto foi programado sem eu saber direito
	// como funcionavam as coisas, agora estão mais claras.
	public function actionCreate()
	{
		$modelRequerimento=new SS_Requerimento;

		if(!isset($_GET['form'])){
			throw new CHttpException(400,'Infelizmente existe algo errado.');
		}
		else{
			$form = $_GET['form'];
		}

		switch($form){
			case $this->getSiglaReqRegistroEscolar():
				$model=new SS_RequerimentoAlunoRegistroEscolar;


				$criteria = new CDbCriteria();
				$criteria->compare('CDModeloRequerimento',1);
				$modelMD = SS_ModeloRequerimento::model()->find($criteria);

				$model->CDRequerimentoAlunoRegistroEscolar
				= ($modelMD->NumeracaoRequerimento+1);

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',1);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case $this->getSiglaReqTecnico():
				$model=new SS_RequerimentoAlunoTecnico;

				$criteria = new CDbCriteria();
				$criteria->compare('CDModeloRequerimento',2);
				$modelMD = SS_ModeloRequerimento::model()->find($criteria);

				$model->CDRequerimentoAlunoTecnico
				= ($modelMD->NumeracaoRequerimento+1);

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',2);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case $this->getSiglaReqTecnicoFG():
				$model=new SS_RequerimentoAlunoTecnicoFG;

				$criteria = new CDbCriteria();
				$criteria->compare('CDModeloRequerimento',5);
				$modelMD = SS_ModeloRequerimento::model()->find($criteria);

				$model->CDRequerimentoAlunoTecnico
				= ($modelMD->NumeracaoRequerimento+1);



					// Define o modelo de requerimento
					$criteria = new CDbCriteria;
					$criteria->compare('CDModeloRequerimento',5);
					$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
					break;
			case $this->getSiglaReqGraduacao():
				$model=new SS_RequerimentoAlunoGraduacao;

				$criteria = new CDbCriteria();
				$criteria->compare('CDModeloRequerimento',3);
				$modelMD = SS_ModeloRequerimento::model()->find($criteria);

				$model->CDRequerimentoAlunoGraduacao
				= ($modelMD->NumeracaoRequerimento+1);

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',3);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			case $this->getSiglaReqEstagio():
				$model=new SS_RequerimentoAlunoEstagio;

				$criteria = new CDbCriteria();
				$criteria->compare('CDModeloRequerimento',4);
				$modelMD = SS_ModeloRequerimento::model()->find($criteria);

				$model->CDRequerimentoAlunoEstagio
				= ($modelMD->NumeracaoRequerimento+1);

				// Define o modelo de requerimento
				$criteria = new CDbCriteria;
				$criteria->compare('CDModeloRequerimento',4);
				$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);
				break;
			default:
				throw new CHttpException(400,'Infelizmente existe algo errado.');
				break;

		}

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

		$valida = true;
		if(isset($_POST['SS_Requerimento']))
		{
			$modelRequerimento->attributes = $_POST['SS_Requerimento'];
			$modelRequerimento->relOpcao = $_POST['SS_Requerimento']['relOpcao'];

			// Coloca a situação do requerimento como Enviado
			$modelRequerimento->relSituacao = array(1);

			if(isset($_POST['Disciplina']) and isset($_POST['Professor'])){
				if(empty($_POST['Disciplina'])){
					$modelRequerimento->addError('CDRequerimento','Deve-se selecionar uma disciplina.');
					$valida = false;
				}
				if(empty($_POST['Professor'])){
					$modelRequerimento->addError('CDRequerimento','Deve-se selecionar um professor.');
					$valida = false;
				}
				if(empty($_POST['DataProva'])){
					$modelRequerimento->addError('CDRequerimento','Deve-se preencher a data da prova.');
					$valida = false;
				}

			}

			// código não está bom heim....refactoring...

			if($valida && $modelRequerimento->save()){

				$idReq = null;
				$opcoesPDF = array();
				foreach($modelRequerimento->relOpcao as $req){
					$criteria = new CDbCriteria;
					$criteria->compare('SS_Opcao_CDOpcao',$req);
					$criteria->compare('SS_Requerimento_CDRequerimento',
					$modelModeloRequerimento->CDModeloRequerimento);
					$modelOMR = SS_OpcaoModeloRequerimento::model()->find($criteria);
					if($modelOMR->GerarRequerimentoImpresso == 1){
						$idReq = 1;
						break;
					}
				}
				if(!is_null($idReq)){
					$idReq = $modelRequerimento->CDRequerimento;
				}

				$model->SS_Requerimento_CDRequerimento = $modelRequerimento->CDRequerimento;
				$model->Ano = date("Y");
				if($model->save()){

					$obs = '';

					if(isset($_POST['NMEmpresa'])){
						$obs .= "Nome da Empresa: ".$_POST['NMEmpresa'];
						$modelRequerimento->Observacoes = $modelRequerimento->Observacoes." <br />".$obs;
						$modelRequerimento->save();
					}

					if(isset($_POST['Disciplina']) and isset($_POST['Professor'])){

						$criteria = new CDBCriteria;
						$criteria->compare('CDServidor',$_POST['Professor']);
						$criteria->select = 'NMServidor,EmailInstitucional';
						$modelProf = Servidor::model()->find($criteria);

						$criteria = new CDBCriteria;
						$criteria->compare('CDDisciplina',$_POST['Disciplina']);
						$criteria->select = 'NMDisciplina';
						$modelDisc = Disciplina::model()->find($criteria);

						$emailProf = $modelProf->EmailInstitucional;
						$nomeProf = $modelProf->NMServidor;
						$obs = '<p><strong>Solicitação:</strong> Prova de Segunda Chamada';
						$obs .= '<br /><strong>Aluno:</strong> ';
						$obs .= $modelRequerimento->relAluno->NMAluno.' ';
						$obs .= '<br /><strong>Disciplina:</strong> ';
						$obs .= $modelDisc->NMDisciplina.' ';
						$obs .= '<br /><strong>Professor:</strong> ';
						$obs .= $nomeProf.' ('.$emailProf.')';
						$obs .= '<br /><strong>Data da prova:</strong> ';
						$obs .= $_POST['DataProva'].' </p>';
						$this->enviaEmail($model,1,$obs,$emailProf,$nomeProf);

						// grava informações do professor no OBS, é bom?
						// da pra melhorar, tá meio POG heim
						$modelRequerimento->Observacoes = $modelRequerimento->Observacoes." <br />".$obs;
						$modelRequerimento->save();
					}
					else{
						$this->enviaEmail($model,1,$obs);
					}

					$criteria = new CDbCriteria();
					$criteria->compare('CDModeloRequerimento',$modelModeloRequerimento->CDModeloRequerimento);
					$modelMD = SS_ModeloRequerimento::model()->find($criteria);
					$modelMD->NumeracaoRequerimento = $modelMD->NumeracaoRequerimento+1;
					$modelMD->save();

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
			case $this->siglaReqTecnicoFG:
				$num = SS_RequerimentoAlunoTecnicoFG::model()->getLastRecord();
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
		if(!isset($_GET['Req'])){
			throw new CHttpException(400,'Infelizmente existe algo errado.');
		}
		else{
			$opcaoRequerimento = $_GET['Req'];
		}

		if(isset($_GET['saveSuccess'])){
			$saveSuccess = $_GET['saveSuccess'];
		}
		else{
			$saveSuccess = null;
		}

		if(isset($_GET['idReq'])){
			$idReq = $_GET['idReq'];
		}
		else{
			$idReq = null;
		}

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
				case $this->getSiglaReqTecnicoFG():
					$tipoReq = 5;
					$model=new SS_RequerimentoAlunoTecnicoFG('search');
					break;
				default:
					throw new CHttpException(400,'Infelizmente existe algo errado.');
			}
		// Define o modelo de requerimento
		$criteria = new CDbCriteria;
		$criteria->compare('CDModeloRequerimento',$tipoReq);
		$modelModeloRequerimento = SS_ModeloRequerimento::model()->find($criteria);

		// para tamanho da página selecionada no gridview
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
		}

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SS_RequerimentoAlunoRegistroEscolar']))
			$model->attributes=$_GET['SS_RequerimentoAlunoRegistroEscolar'];
		if(isset($_GET['SS_RequerimentoAlunoTecnico']))
			$model->attributes=$_GET['SS_RequerimentoAlunoTecnico'];
		if(isset($_GET['SS_RequerimentoAlunoTecnicoFG']))
			$model->attributes=$_GET['SS_RequerimentoAlunoTecnicoFG'];
		if(isset($_GET['SS_RequerimentoAlunoGraduacao']))
			$model->attributes=$_GET['SS_RequerimentoAlunoGraduacao'];
		if(isset($_GET['SS_RequerimentoAlunoEstagio']))
			$model->attributes=$_GET['SS_RequerimentoAlunoEstagio'];

		$this->render('//controleRequerimentos/admin',array(
			'model'=>$model,'modelModeloRequerimento'=>$modelModeloRequerimento,
			'saveSuccess'=>$saveSuccess,'idReq'=>$idReq,
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
				throw new CHttpException(404,'Esta página não existe.');
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

	private function EnviaEmail(){

		$configPam = new ConfigApp();
		$ipServerNTI = $configPam->ipServer;
		$ipServer =  gethostbyname($_SERVER['SERVER_NAME']);
		if($ipServer != $ipServerNTI){
			return true;
		}

		$parametros = func_get_args();

		$model = $parametros[0];
		$situacao = $parametros[1];
		$obs = $parametros[2];

		$emails = array();

		// trata professores para receber email.
		if(func_num_args() == 5){
			$email = $parametros[3];
			$nome = $parametros[4];
			$emails[$email] = $nome;
			//$emails['leonardofribeiro@gmail.com'] ='LeoRibeiro';
			$message = new YiiMailMessage();
			$message->setTo($emails);
	        $message->setFrom(array('nti@timoteo.cefetmg.br'));
			$subject = 'Requerimento: '.$model->getNumRequerimento().' - CEFET-MG Timóteo';
			// melhorar isso aqui, está horrível
			$hora = date("H"); 
			if($hora >= 0 && $hora < 6) { 
				$comprimento = "boa madrugada"; 
			} 
			else if ($hora >= 6 && $hora < 12){ 
				$comprimento = "bom dia"; 
			} 
			else if ($hora >= 12 && $hora < 18) { 
				$comprimento = "boa tarde"; 
			} 
			else{ 
				$comprimento = "boa noite"; }

	        $message->setSubject($subject);
			$body = '<p>Caro docente, '.$comprimento.'. <br /><br />';
			$body .= 'Existe uma solicitação para você. Procure o coordenador
			do curso para continuidade na tramitação do requerimento.</p>';
			$body .= $obs;
			$body .= '<p>Este é um email automático. Por favor, não responda.</p>';
			$body .='<p><br><br><br><br>NTI - Núcleo de Tecnologia da Informação - CEFET-MG Campus Timóteo</p>';
			$message->setBody($body,'text/html');

	        $numsent = Yii::app()->mail->send($message);

		}

		$emails = array();

		$criteriaS=new CDbCriteria;
	    $criteriaS->compare('CDSituacao',$situacao);
		$modelS =SS_Situacao::model()->find($criteriaS);
		if(!is_null($modelS))
			$situacao = $modelS->NMsituacao;

		$message = new YiiMailMessage();
		$aluno = $model->relRequerimento->relAluno->NMAluno;
		$emailAluno = $model->relRequerimento->relAluno->Email;

		$criteriaS=new CDbCriteria;
	    $criteriaS->compare('Aluno_CDAluno',$model->relRequerimento->relAluno->CDAluno);

		$modelT =AlunoTecnico::model()->find($criteriaS);

		$modelG =AlunoGraduacao::model()->find($criteriaS);

		$criteriaS=new CDbCriteria;	
		if(!is_null($modelT)){
			$criteriaS->compare('CursoTecnico_CDCurso',$modelT->CursoTecnico_CDCurso);
		}
		if(!is_null($modelG)){
			$criteriaS->compare('CursoGraduacao_CDCurso',
			$modelG->CursoGraduacao_CDCurso);
		}
	    $criteriaS->compare
	    ('SS_ModeloRequerimento_CDModeloRequerimento',
	    $model->relRequerimento->SS_ModeloRequerimento_CDModeloRequerimento);
	    $modelsA =SS_ModeloRequerimentoServidor::model()->
	    findAll($criteriaS);

	    foreach($modelsA as $modelAa){
			$emails[$modelAa->relServidor->EmailInstitucional] =
			$modelAa->relServidor->NMServidor;
	    }
		$emails[$emailAluno] =$aluno;
        $message->setTo($emails);
        $message->setFrom(array('nti@timoteo.cefetmg.br'));
		$subject = 'Requerimento: '.$model->getNumRequerimento().' - CEFET-MG Timóteo';
        $message->setSubject($subject);

        $body = '<p>Requerimento solicitado pelo(a) aluno(a) <strong>'.$aluno.'.</strong></p>';
		$body .= '<p>Situação: <strong>'.$situacao.'.</strong></p>';
		$body .= '<p>'.$obs.'</p>';
        $body .= '<p>Para visualizar todos os dados do requerimento ';
        $body .= '<strong>'.CHtml::link('clique aqui',
        'http://sistemas.timoteo.cefetmg.br'.Yii::app()->createUrl("Requerimentos/view", 
        array("id" => $model->relRequerimento->CDRequerimento))).'.</strong></p>';
        $body .= '<p>Este é um email automático. Por favor, não responda.</p>';
        $body .='<p><br><br><br><br>NTI - Núcleo de Tecnologia da Informação - CEFET-MG Campus Timóteo</p>';
        $message->setBody($body,'text/html');

        $numsent = Yii::app()->mail->send($message);
	}

	public function actionSegundaChamada(){

		$tipo = null;
		if(isset($_POST['Tipo'])){
			$tipo = $_POST['Tipo'];
		}
		$turma = null;
		$coord = null;
		if(!is_null(Yii::app()->user->getModelAluno())){
			if(Yii::app()->user->getTipoAluno() == 1){
				$aluno = Yii::app()->user->getModelAluno()->CDAluno;
				$criteria = new CDBCriteria;
				$criteria->together = array('relCurso');
				$criteria->compare('Aluno_CDAluno',$aluno);
				$modelAlunoTecnico = AlunoTecnico::model()->find($criteria);
				$turma = $modelAlunoTecnico->Turma_CDTurma;

				$turmaControle = $modelAlunoTecnico->relTurma->relTurmaDisciplina;

				$DiscTurma = array();
				foreach($turmaControle as $turmaI){
					$DiscTurma[] = $turmaI->CDDisciplina;

				}

				// É necessário remodelar algumas coisas no Banco de Dados
				// O que vamos fazer aqui é uma POG, tome cuidado
				if($tipo == 1){
					$curso = $modelAlunoTecnico->relCurso->NMCurso;
				}
				else{
					// Formação geral
					// não é o ideal, me ajude a melhorar isso aqui.
					$criteria = new CDBCriteria;
					$criteria->compare('CDCoordenacao',5);
					$modelC = Coordenacao::model()->find($criteria);
					$curso =$modelC->NMCoordenacao;
				}

				$criteria = new CDBCriteria;
				$criteria->compare('NMCoordenacao',$curso,true);
				$criteria->select = 'CDCoordenacao';
				$modelCoordenacao = Coordenacao::model()->find($criteria);
				$coord = $modelCoordenacao->CDCoordenacao;

			}

		}

		$model = Disciplina::model()->with('relCoordenacao')->findAll(
		 array('order'=>'NMDisciplina','condition'=>'relCoordenacao.CDCoordenacao=:COOR',
	    'params'=>array(':COOR'=>$coord)));

	    $DiscCoord = array();
	    foreach($model as $m){
			$DiscCoord[] = $m->CDDisciplina;
	    }

	    $DiscCoord = array_intersect($DiscCoord,$DiscTurma);

	    $criteria = new CDBCriteria;
	    $criteria->order = 'NMDisciplina';
	    $criteria->addInCondition('CDDisciplina',$DiscCoord);
		$model = Disciplina::model()->findAll($criteria);

	    // gambiarra, to na espanha, sem computador, sem utilizar controle de versao
		// e utilizando sftp
	    //if($tipo != 1){
		$modelP = Professor::model()->with('relServidor')->findAll(
		 array('order'=>'NMServidor'));
        //}
		//else{
		//$modelP = Professor::model()->with('relServidor','relCoordenacao')->findAll(
		// array('order'=>'NMServidor','condition'=>'relCoordenacao.CDCoordenacao=:COOR',
	    //'params'=>array(':COOR'=>$coord)));
		//}

	    $data=CHtml::listData($model,'CDDisciplina','NMDisciplina');
		$dataP=CHtml::listData($modelP,'relServidor.CDServidor','relServidor.NMServidor');

		$dados = array();

		$dados['data'] = $data;
		$dados['dataP'] = $dataP;

		$this->renderPartial('_segundaChamada', $dados, false, true);

	}

	public function actionCartaEstagio(){
	?>
		<fieldset>
		<legend>Dados da Empresa</legend>
		<div class="row">
			<?php echo CHtml::label('Nome da Empresa','NMEmpresa'); ?>
			<?php echo CHtml::textField('NMEmpresa','', 
			array('style'=>'width:220px')); ?>
		</div>
		</fieldset>
	<?
	}

}
