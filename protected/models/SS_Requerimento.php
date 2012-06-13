<?php

/**
 * This is the model class for table "SS_Requerimento".
 *
 * The followings are the available columns in table 'SS_Requerimento':
 * @property integer $CDRequerimento
 * @property integer $SS_ModeloRequerimento_CDModeloRequerimento
 * @property integer $Aluno_CDAluno
 * @property string $Observacoes
 */
class SS_Requerimento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_Requerimento the static model class
	 */
	
	public $NumRequerimento;
	public $TotalReq;
	public $MaxCol;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'SS_Requerimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SS_ModeloRequerimento_CDModeloRequerimento, Aluno_CDAluno', 'required'),
			array('SS_ModeloRequerimento_CDModeloRequerimento, Aluno_CDAluno', 'numerical', 'integerOnly'=>true),
			array(
		      'relOpcao','required',
		      'message' => 'Deve-se selecionar pelo menos uma opção.',
		    ),
			array('Observacoes', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDRequerimento, SS_ModeloRequerimento_CDModeloRequerimento, Aluno_CDAluno, Observacoes,NumRequerimento', 'safe', 'on'=>'search'),
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
			'relOpcao' => array(self::MANY_MANY, 'SS_Opcao', 'SS_OpcaoRequerimento(SS_Requerimento_CDRequerimento,SS_Opcao_CDOpcao)'),
			'relModeloRequerimento' => array(self::BELONGS_TO, 'SS_ModeloRequerimento', 'SS_ModeloRequerimento_CDModeloRequerimento'),
			'relAluno' => array(self::BELONGS_TO, 'Aluno', 'Aluno_CDAluno'),
			'relRequerimentoAlunoEstagio' => array(self::HAS_MANY, 'SS_RequerimentoAlunoEstagio', 'SS_Requerimento_CDRequerimento'),
			'relRequerimentoAlunoGraduacao' => array(self::HAS_MANY, 'SS_RequerimentoAlunoGraduacao', 'SS_Requerimento_CDRequerimento'),
			'relRequerimentoAlunoRegistroEscolar' => array(self::HAS_MANY, 'SS_RequerimentoAlunoRegistroEscolar', 'SS_Requerimento_CDRequerimento'),
			'relRequerimentoAlunoTecnico' => array(self::HAS_MANY, 'SS_RequerimentoAlunoTecnico', 'SS_Requerimento_CDRequerimento'),
			'relSituacao' => array(self::MANY_MANY, 'SS_Situacao', 'SS_SituacaoRequerimento(SS_Requerimento_CDRequerimento,SS_Situacao_CDSituacao)'),
			
			
			// Situação interessante, para usar campos da tabela gerada
			// no relacionamento N to N
			'Situacao_Requerimento' => array(self::HAS_MANY, 'SS_SituacaoRequerimento', 'SS_Requerimento_CDRequerimento'),
			'Situacao' => array(self::HAS_MANY, 'SS_Situacao', 'SS_Situacao_CDSituacao', 'through' => 'Situacao_Requerimento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDRequerimento' => 'Cdrequerimento',
			'SS_ModeloRequerimento_CDModeloRequerimento' => 'Ss Modelo Requerimento Cdmodelo Requerimento',
			'Aluno_CDAluno' => 'Aluno Cdaluno',
			'Observacoes' => 'Observacoes',
			'relOpcao' => 'Opção',
			'relSituacao' => 'Situação',
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

		$criteria->compare('CDRequerimento',$this->CDRequerimento);

		$criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',$parametros[0]);
		
		$criteria->compare('relRequerimentoAlunoRegistroEscolar.CDRequerimentoAlunoRegistroEscolar',$this->NumRequerimento, true);

		$criteria->compare('Aluno_CDAluno',$this->Aluno_CDAluno);

		$criteria->compare('Observacoes',$this->Observacoes,true);

		return new CActiveDataProvider('SS_Requerimento', array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchTipoRequerimento($tipoRequerimento)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('CDRequerimento',$this->CDRequerimento);

		echo $tipoRequerimento;
		exit();
		//$criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',$this->SS_ModeloRequerimento_CDModeloRequerimento);
		
		$criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',$tipoRequerimento);
		
		$criteria->compare('relRequerimentoAlunoRegistroEscolar.CDRequerimentoAlunoRegistroEscolar',$this->NumRequerimento, true);

		$criteria->compare('Aluno_CDAluno',$this->Aluno_CDAluno);

		$criteria->compare('Observacoes',$this->Observacoes,true);

		return new CActiveDataProvider('SS_Requerimento', array(
			'criteria'=>$criteria,
		));
	}
	
	// Método adicionado junto com a extensão CAdvancedArBehavior
	public function behaviors(){
	          return array( 'CAdvancedArBehavior' => array(
	            'class' => 'application.extensions.CAdvancedArBehavior'),
	          	'LoggableBehavior'=>
				            'application.modules.auditTrail.behaviors.LoggableBehavior');
	}
	
	
	public function getUltimaSituacao($CDRequerimento,$tipo){
	   $criteria = new CDbCriteria;
	   $criteria->with = array('relRequerimento','Situacao_Requerimento','Requerimento');
	   $criteria->together = true;
	   $criteria->compare('relRequerimento.CDRequerimento',$CDRequerimento);
	   //$criteria->compare('relRequerimento.Aluno_CDAluno',Yii::app()->user->getModelAluno()->CDAluno); // colocar aluno da sessao
	   $criteria->compare('Situacao_Requerimento.SS_Requerimento_CDRequerimento',$CDRequerimento);
	   $criteria->order = 'Situacao_Requerimento.DataHora DESC';
	   $registro = SS_Situacao::model()->find($criteria);

	   if(is_null($registro)){
		return "Erro";
	   }
	
	   //gambiarra, não tenho tempo para analisar, favor olhar.
		foreach($registro->Situacao_Requerimento as $req){
			$DataHora = $req->DataHora;
		}
		
	   if($tipo == 1){
		return ($registro->NMsituacao);
	   }
	   else{
		return ($this->mysql_datetime_para_humano($DataHora));
	   }
	}
	
	public function mysql_datetime_para_humano($dt) {
	$yr=strval(substr($dt,0,4));
	$mo=strval(substr($dt,5,2));
	$da=strval(substr($dt,8,2));
	$hr=strval(substr($dt,11,2));
	$mi=strval(substr($dt,14,2));
	$se=strval(substr($dt,17,2));
	return date("d/m/Y H:i:s", mktime ($hr,$mi,$se,$mo,$da,$yr));
	}
	
	
	public function getPrecisaGerarPDF(){
		
		$criteria = new CDbCriteria;
		$criteria->compare('CDModeloRequerimento',
		$this->SS_ModeloRequerimento_CDModeloRequerimento);
		$modelMR = SS_ModeloRequerimento::model()->find($criteria);
		
		// $criteria = new CDbCriteria;
		// $criteria->compare('SS_Requerimento_CDRequerimento',
		// $modelMR->CDModeloRequerimento);
		// $criteria->compare('GerarRequerimentoImpresso',1);
		// $modelOMR = SS_OpcaoModeloRequerimento::model()->findAll($criteria);
		
		foreach($this->relOpcao as $req){
			$criteria = new CDbCriteria;
			$criteria->compare('SS_Opcao_CDOpcao',$req->CDOpcao);
			$modelOMR = SS_OpcaoModeloRequerimento::model()->find($criteria);
			if($modelOMR->GerarRequerimentoImpresso == 1){
				return true;
			}
		}
		return false;

	}

	
}