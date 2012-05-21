<?php

class RelatoriosPDFController extends Controller
{

	private $PDF;
	
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
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('geraPDF'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function Cabecalho(){

		
		$this->PDF -> SetMargins(5, 5, 2);
		$this->PDF -> SetAutoPageBreak(1,0);

		$this->PDF->Open();                    
		$this->PDF->AddPage();                
		$this->PDF->SetFont("Arial", "B", 10 ,"UTF-8");

		$cefet = YiiBase::getPathOfAlias('webroot')."/images/cefetlogo.jpg";
		$nti = YiiBase::getPathOfAlias('webroot')."/images/ntilogo.jpg";

		$this->PDF->Cell(0, 2, $this->PDF->Image($cefet,6,13,21.10,14.84));
		$this->PDF->Cell(0, 2, $this->PDF->Image($nti,186,13,18.10,14.84));
		$this->PDF->Ln(1);
		$this->PDF->SetFont("Arial", "B", 9 ,"UTF-8");
		$this->PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','SERVIÇO PÚBLICO FEDERAL'),'LRT', 1, 'C');
		$this->PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','MINISTÉRIO DA EDUCAÇÃO'),'LR', 1, 'C');
		$this->PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','CENTRO FEDERAL DE EDUCAÇÃO TECNOLÓGIA DE MINAS GERAIS'),'LR', 1, 'C');
		//$PDF->Cell(200, 5,iconv('utf-8','iso-8859-1','Autorização de Funcionamento - Portaria 2.026 de 28/12/2006 DOU de 29/12/2006'),'LR', 1, 'C');
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','Avenida Amazonas, 1193, Bairro Vale Verde - CEP 35183-006') , 'LR', 1, 'C');
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','Timóteo - MG - Campus Timóteo - Fone: (31) 3845-4617 ') , 'LRB', 1, 'C');
		

	}
	
	
	public function dadosAluno($modelReqEsp,$modelReq,$modelAluno){
		
		if(!is_null($modelAluno->relCidade)){
			$cidade = $modelAluno->relCidade->NMCidade.
			" - ".$modelAluno->relCidade->relEstado->NMEstado;
		}
		else{
			$cidade = "";
		}
		
		$modelosAluno = array(
	   "AlunoGraduacao",
	   "AlunoTecnico");

	   $modelAlunoEsp = null;
	   $contReq = 0;
	   while(is_null($modelAlunoEsp)){
		   $criteria = new CDbCriteria;
		   $criteria->compare('Aluno_CDAluno',
		   $modelAluno->CDAluno);
		   $objReq = new $modelosAluno[$contReq];
		   $modelAlunoEsp = $objReq::model()->find($criteria);
		   $contReq++;
	   }
	   if($modelAlunoEsp->tableName() =="AlunoGraduacao"){
		   $NMSerie = "Período";
		   $ValorSerie = $modelAlunoEsp->Periodo;
	   }
	else{
		   $NMSerie = "Série";
		   $ValorSerie = $modelAlunoEsp->Serie;		
	}
		
		$this->PDF->Ln(5);
		$this->PDF->SetFont("Arial", "B", 12 ,"UTF-8");
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1',$modelReq->relModeloRequerimento->NMModeloRequerimento) , 0, 1, 'C');
		$this->PDF->Ln(5);
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Protocolo:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$modelReqEsp->getNumRequerimento()) , 0, 0, 'L');
		
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1','Pedido feito em:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(80, 5, iconv('utf-8','iso-8859-1',$modelReq->getUltimaSituacao($modelReq->CDRequerimento,2)) , 0, 1, 'L');
		
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Nome:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$modelAluno->NMAluno) , 0, 0, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1','Matrícula:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(65, 5, iconv('utf-8','iso-8859-1',$modelAluno->NumMatricula) , 0, 1, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Endereço:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$modelAluno->EnderecoRua." - ".$modelAluno->EnderecoNumero) , 0, 0, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1','Bairro:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(65, 5, iconv('utf-8','iso-8859-1',$modelAluno->Bairro) , 0, 1, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Cidade:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$cidade) , 0, 0, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1','CEP:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(65, 5, iconv('utf-8','iso-8859-1',$modelAluno->CEP) , 0, 1, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','E-mail:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$modelAluno->Email) , 0, 0, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1','Telefone:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(30, 5, iconv('utf-8','iso-8859-1',$modelAluno->Telefone) , 0, 1, 'L');

		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Curso:') , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(101, 5, iconv('utf-8','iso-8859-1',$modelAlunoEsp->relCurso->NMCurso) , 0, 0, 'L');
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(18, 5, iconv('utf-8','iso-8859-1',$NMSerie.":") , 0, 0, 'R');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(40, 5, iconv('utf-8','iso-8859-1',$ValorSerie) , 0, 1, 'L');
			
		$this->PDF->Ln(3);
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','') , 'B', 1, 'L');
		$this->PDF->Ln(3);
	
	}
	
	
	public function opcoesReq($modelReq){
		
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->SetFillColor(255,255,255);
		$this->PDF->MultiCell(190, 5, iconv('utf-8','iso-8859-1','Venho requerer a(s) seguinte(s) solicitação(ões):') , 0, 1, 'J');

		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$cont = 1;
		foreach($modelReq->relOpcao as $opcao){
			$this->PDF->Cell(180, 5, 
			iconv('utf-8','iso-8859-1',$cont." - ".$opcao->NMOpcao) , 0, 1, 'L');
			$cont++;
		}
		
		$this->PDF->Ln(3);
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','') , 'B', 1, 'L');
		$this->PDF->Ln(3);
	}
	
	public function obsReq($modelReq){

		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1','Observações:') , 0, 1, 'L');
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->MultiCell(200, 5, iconv('utf-8','iso-8859-1',
		$modelReq->Observacoes) , 0, 1, 'L');
		
		$this->PDF->Ln(3);
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1','') , 'B', 1, 'L');
		$this->PDF->Ln(3);
	}
	
	public function assRe(){
		
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->setX(25);

		switch (date("m")) {
	        case "01":    $mes = "Janeiro";     break;
	        case "02":    $mes = "Fevereiro";   break;
	        case "03":    $mes = "Março";       break;
	        case "04":    $mes = "Abril";       break;
	        case "05":    $mes = "Maio";        break;
	        case "06":    $mes = "Junho";       break;
	        case "07":    $mes = "Julho";       break;
	        case "08":    $mes = "Agosto";      break;
	        case "09":    $mes = "Setembro";    break;
	        case "10":    $mes = "Outubro";     break;
	        case "11":    $mes = "Novembro";    break;
	        case "12":    $mes = "Dezembro";    break; 
	 }
	 	$this->PDF->Ln(5);
		$this->PDF->Cell(25, 5, iconv('utf-8','iso-8859-1',
		'Timóteo, '.date('d').' de '.$mes.' de '.date('Y')).'.' , 0, 1, 'L');
		$this->PDF->Ln(8);
		$this->PDF->setX(25);
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(80, 5, iconv('utf-8','iso-8859-1','') , '', 0, 'C');
		$this->PDF->Cell(80, 5, iconv('utf-8','iso-8859-1','') , '', 1, 'C');
		$this->PDF->setX(25);
		$this->PDF->SetFont("Arial", "", 11 ,"UTF-8");
		$this->PDF->Cell(80, 13, iconv('utf-8','iso-8859-1','__________________________________') , '', 0, 'C');
		$this->PDF->Cell(80, 13, iconv('utf-8','iso-8859-1','__________________________________'), '', 1, 'C');
		$this->PDF->setX(25);
		$this->PDF->SetFont("Arial", "B", 11 ,"UTF-8");
		$this->PDF->Cell(80, 5, iconv('utf-8','iso-8859-1','Assinatura do Aluno') , '', 0, 'C');
		$this->PDF->Cell(80, 5, iconv('utf-8','iso-8859-1','Assinatura do Servidor') , '', 1, 'C');
		$this->PDF->setY(285);
		$this->PDF->Cell(200, 5, iconv('utf-8','iso-8859-1', 'Documento gerado em '.date('H:i:s d/m/Y').'. Núcleo de Tecnologia da Informação - nti@timoteo.cefetmg.br'), 'TBLR', 1, 'C');
	}
	
	public function actionGeraPDF(){
		
		$idReq = $_GET['idReq'];
		
		$models = $this->RetornaModelosReq($idReq);

		Yii::import('application.extensions.fpdf.*');
		require('fpdf.php');
		
		$this->PDF = new FPDF("P","mm","A4");
		
		$this->Cabecalho();
		
		$modelReq = $models[0];
		$modelAluno = $models[1];
		$modelReqEsp = $models[2];
		
		$this->dadosAluno($modelReqEsp,$modelReq,$modelAluno);
		
		$this->opcoesReq($modelReq);
		
		if(!empty($modelReq->Observacoes)){
			$this->obsReq($modelReq);	
		}
		
		$this->assRe();
		
		$tipo = "D";
		if(!empty($_GET['tipo']))
			$tipo = $_GET['tipo'];



		//imprime a saida do arquivo..
		$this->PDF->Output("REQ_CEFETMG_".$modelReqEsp->getNumRequerimento().".pdf",$tipo);
	}
	
	public function RetornaModelosReq($CDRequerimento){
	
	   $modelsRetorno = array();
	
	   $criteria = new CDbCriteria;
	   $criteria->compare('CDRequerimento',$CDRequerimento);
	   $modelRequerimento = SS_Requerimento::model()->find($criteria);
	
	   $modelRetorno[] = $modelRequerimento;

	   $criteria = new CDbCriteria;
	   $criteria->compare('CDAluno',$modelRequerimento->Aluno_CDAluno);
	   $modelAluno = Aluno::model()->find($criteria);
	
	   $modelRetorno[] = $modelAluno;
	
	   $modelosRequerimento = array(
	   "SS_RequerimentoAlunoRegistroEscolar",
	   "SS_RequerimentoAlunoTecnico",
	   "SS_RequerimentoAlunoGraduacao",
	   "SS_RequerimentoAlunoEstagio");
	
	   $modelReqEsp = null;
	   $contReq = 0;
	   while(is_null($modelReqEsp)){
		   $criteria = new CDbCriteria;
		   $criteria->compare('SS_Requerimento_CDRequerimento',
		   $modelRequerimento->CDRequerimento);
		   $objReq = new $modelosRequerimento[$contReq];
		   $modelReqEsp = $objReq::model()->find($criteria);
		   $contReq++;
	   }
	
	   $modelRetorno[] = $modelReqEsp;
	
	//    print_r($modelRetorno);
	// exit();
	
	   return $modelRetorno;

	
	}

}
