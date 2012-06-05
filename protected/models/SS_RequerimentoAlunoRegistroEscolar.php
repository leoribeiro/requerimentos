<?php

/**
 * This is the model class for table "SS_RequerimentoAlunoRegistroEscolar".
 *
 * The followings are the available columns in table 'SS_RequerimentoAlunoRegistroEscolar':
 * @property integer $CDRequerimentoAlunoRegistroEscolar
 * @property string $Ano
 * @property integer $SS_Requerimento_CDRequerimento
 * @property string $AnoConclusao
 */
class SS_RequerimentoAlunoRegistroEscolar extends CActiveRecord
{
	
	public $SgReq = "RR";
	public $NumRequerimento;
	public $Situacao;
	public $DtPedido;
	public $nomeAluno;
	public $situacaoCDSituacao;
	public $DataPesquisa;
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_RequerimentoAlunoRegistroEscolar the static model class
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
		return 'SS_RequerimentoAlunoRegistroEscolar';
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
			array('AnoConclusao', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDRequerimentoAlunoRegistroEscolar, Ano, SS_Requerimento_CDRequerimento, AnoConclusao,Situacao,nomeAluno,DtPedido,DataPesquisa', 'safe', 'on'=>'search'),
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
			'CDRequerimentoAlunoRegistroEscolar' => 'Cdrequerimento Aluno Registro Escolar',
			'Ano' => 'Ano',
			'SS_Requerimento_CDRequerimento' => 'Ss Requerimento Cdrequerimento',
			'AnoConclusao' => 'Ano Conclusao',
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
		$criteria->with = array('relRequerimento',
		'relRequerimento.Situacao_Requerimento',
		'relRequerimento.relAluno');
		
		$criteria->together = true;
		
		if(isset($parametros[0])){
			$criteria->compare('relRequerimento.Aluno_CDAluno',
			Yii::app()->user->getModelAluno()->CDAluno);
		}
		
		$criteria->compare('CDRequerimentoAlunoRegistroEscolar',
		$this->CDRequerimentoAlunoRegistroEscolar);
		
		$criteria->compare('relAluno.NMAluno',$this->nomeAluno,true);
		
		
		$criteriaS=new CDbCriteria;
		$criteriaS->compare('SS_Requerimento_CDRequerimento',
		$this->SS_Requerimento_CDRequerimento);
		$criteriaS->order = 'DataHora DESC';
		$modelS = SS_SituacaoRequerimento::model()->find($criteriaS);

		$criteria->compare('Situacao_Requerimento.SS_Situacao_CDSituacao',
		$this->Situacao,true);	
		
		//$criteria->group = 'Situacao_Requerimento.SS_Requerimento_CDRequerimento';

		
		

		$criteria->compare('Ano',$this->Ano,true);
	
		$criteria->compare('SS_Requerimento_CDRequerimento',
		$this->SS_Requerimento_CDRequerimento);

		$criteria->compare('AnoConclusao',$this->AnoConclusao,true);
		
		$criteria->order = 'CDRequerimentoAlunoRegistroEscolar DESC'; 

		return new CActiveDataProvider('SS_RequerimentoAlunoRegistroEscolar', array(
			'criteria'=>$criteria,
		));
	}
	
	public function scopes()
	{
	    return array(
	        'lastRecord'=>array(
	            //'condition'=>'',
	            'order'=>'CDRequerimentoAlunoRegistroEscolar DESC',
	            'limit'=>1,
	        ),
	    );
	}
	
	public function getLastRecord(){
       $registro = SS_RequerimentoAlunoRegistroEscolar::model()->lastRecord()->find();
	   if(is_null($registro)){
		return 0;
	   }
       return $registro->CDRequerimentoAlunoRegistroEscolar;
	}
	
	
	public function getNumRequerimento(){
	       return ($this->SgReq . str_pad($this->CDRequerimentoAlunoRegistroEscolar, 4, "0", STR_PAD_LEFT) . "/" .$this->Ano);
	 }
	
	public function behaviors()
	{
	    return array(
	        'LoggableBehavior'=>
	            'application.modules.auditTrail.behaviors.LoggableBehavior',
	    );
	}
	
}