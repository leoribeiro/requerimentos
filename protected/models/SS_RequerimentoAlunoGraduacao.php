<?php

/**
 * This is the model class for table "SS_RequerimentoAlunoGraduacao".
 *
 * The followings are the available columns in table 'SS_RequerimentoAlunoGraduacao':
 * @property integer $CDRequerimentoAlunoGraduacao
 * @property string $Ano
 * @property integer $SS_Requerimento_CDRequerimento
 */
class SS_RequerimentoAlunoGraduacao extends CActiveRecord
{
	public $SgReq = "RG";
	public $NumRequerimento;
	public $Situacao;
	public $DtPedido;
	public $nomeAluno;
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_RequerimentoAlunoGraduacao the static model class
	 */	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SS_RequerimentoAlunoGraduacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SS_Requerimento_CDRequerimento', 'required'),
			array('SS_Requerimento_CDRequerimento', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDRequerimentoAlunoGraduacao, Ano, SS_Requerimento_CDRequerimento,NumRequerimento,Situacao,DtPedido,nomeAluno', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'relRequerimento' => array(self::BELONGS_TO, 'SS_Requerimento', 'SS_Requerimento_CDRequerimento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDRequerimentoAlunoGraduacao' => 'Código',
			'Ano' => 'Ano',
			'SS_Requerimento_CDRequerimento' => 'Ss Requerimento Cdrequerimento',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		
		$parametros = func_get_args();

		$criteria=new CDbCriteria;
		$criteria->with = array('relRequerimento');
		$criteria->together = true;
		
		if(isset($parametros[0])){
			$criteria->compare('relRequerimento.Aluno_CDAluno',
			Yii::app()->user->getModelAluno()->CDAluno);
		}

		// tentando resolver o problema de listar situações
		// melhores sugestões são bem vindas, tá meio complexo.
		// e provavelmente com o tempo vai ficar lento...
		// preciso estudar mais sql.
		$criteriaS=new CDbCriteria;
		$criteriaS->select = 'SS_Requerimento_CDRequerimento';
		$modelS = SS_RequerimentoAlunoGraduacao::model()->findAll($criteriaS);
		$ReqsID = array();
		foreach($modelS as $modelI){
			$ReqsID[] = $modelI->SS_Requerimento_CDRequerimento;
        }		
		$criteriaS=new CDbCriteria;
		$criteriaS->select = 'SS_Requerimento_CDRequerimento,MAX(DataHora) as MaxCol';
		$criteriaS->addInCondition('SS_Requerimento_CDRequerimento',$ReqsID);
		$criteriaS->group = 'SS_Requerimento_CDRequerimento';
		$criteriaS->order = 'DataHora DESC';
		$modelS = SS_SituacaoRequerimento::model()->findAll($criteriaS);

		$ReqsIDOrig = $ReqsID;
		
		$ReqsID = array();
		foreach($modelS as $modelI){
			$ReqsID[] = $modelI->MaxCol;
        }
		
		$criteriaS=new CDbCriteria;
		$criteriaS->select = 'SS_Requerimento_CDRequerimento,SS_Situacao_CDSituacao';
		$criteriaS->compare('SS_Situacao_CDSituacao',
		$this->Situacao);
		$criteriaS->addInCondition('DataHora',$ReqsID);
		$criteriaS->order = 'DataHora DESC';
		$modelS = SS_SituacaoRequerimento::model()->findAll($criteriaS);
		
		$ReqsID = array();
		foreach($modelS as $modelI){
			$ReqsID[] = $modelI->SS_Requerimento_CDRequerimento;
        }
		
		// criar um método, ou extensão ou algo para esse pedaço de código
		$DtPedido2 = null;
		if($this->DtPedido != ''){
			$Data= $this->DtPedido;
			$ar = explode('/', $Data);
			if(count($ar) == 3)
				$this->DtPedido = $ar[2].'-'.$ar[1].'-'.$ar[0];
				$DtPedido2 = $ar[2].'-'.$ar[1].'-'.($ar[0]+1);
				
	    }
	
		$criteriaS=new CDbCriteria;
		$criteriaS->select = 'SS_Requerimento_CDRequerimento,DataHora';
		$criteriaS->compare('DataHora','>='.$this->DtPedido);
		$criteriaS->compare('DataHora','<'.$DtPedido2);
		$criteriaS->addInCondition('SS_Requerimento_CDRequerimento',$ReqsIDOrig);
		$criteriaS->order = 'DataHora DESC';
		$modelS = SS_SituacaoRequerimento::model()->findAll($criteriaS);
		
		if($this->DtPedido != ''){
			$Data= $this->DtPedido;
			$ar = explode('-', $Data);
			if(count($ar) == 3)
				$this->DtPedido = $ar[2].'/'.$ar[1].'/'.$ar[0];
	    }

		$ReqsIDD = array();
		foreach($modelS as $modelI){
			$ReqsIDD[] = $modelI->SS_Requerimento_CDRequerimento;
        }

		$ReqsID = array_intersect($ReqsID,$ReqsIDD);


		// termina código para ser melhorado	

		$criteria->addInCondition('SS_Requerimento_CDRequerimento',$ReqsID);
		

		$ReqEsp = preg_replace("/[^0-9\/]/i", "", $this->NumRequerimento);
		$ReqEsp = ltrim($ReqEsp, "0"); 
		$ReqEsp = explode("/",$ReqEsp); 
		
		$criteria->compare('CDRequerimentoAlunoTecnico',
		$ReqEsp[0],true);
		
		if(isset($ReqEsp[1])){
			$criteria->compare('Ano',$ReqEsp[1],true);
		}
	
		
		$criteria->order = 'CDRequerimentoAlunoGraduacao DESC'; 

		return new CActiveDataProvider('SS_RequerimentoAlunoGraduacao', array(
			'pagination'=>array(
			      'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function scopes()
	{
	    return array(
	        'lastRecord'=>array(
	            //'condition'=>'',
	            'order'=>'CDRequerimentoAlunoGraduacao DESC',
	            'limit'=>1,
	        ),
	    );
	}
	
	public function getLastRecord(){
       $registro = SS_RequerimentoAlunoGraduacao::model()->lastRecord()->find();
	   if(is_null($registro)){
		return 0;
	   }
       return $registro->CDRequerimentoAlunoGraduacao;
	}
	
	public function getNumRequerimento(){
	       return ($this->SgReq . str_pad($this->CDRequerimentoAlunoGraduacao, 4, "0", STR_PAD_LEFT) . "/" . $this->Ano);
	 }
	
	public function behaviors()
	{
	    return array(
	        'LoggableBehavior'=>
	            'application.modules.auditTrail.behaviors.LoggableBehavior',
	    );
	}
	
}