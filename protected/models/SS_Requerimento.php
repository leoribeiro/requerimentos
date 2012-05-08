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
			array('Observacoes', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDRequerimento, SS_ModeloRequerimento_CDModeloRequerimento, Aluno_CDAluno, Observacoes', 'safe', 'on'=>'search'),
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
			'relModeloRequerimento' => array(self::BELONGS_TO, 'SsModeloRequerimento', 'SS_ModeloRequerimento_CDModeloRequerimento'),
			'relAluno' => array(self::BELONGS_TO, 'Aluno', 'Aluno_CDAluno'),
			'sS_RequerimentoAlunoEstagios' => array(self::HAS_MANY, 'SS_RequerimentoAlunoEstagio', 'SS_Requerimento_CDRequerimento'),
			'relRequerimentoAlunoGraduacao' => array(self::HAS_MANY, 'SS_RequerimentoAlunoGraduacao', 'SS_Requerimento_CDRequerimento'),
			'relRequerimentoAlunoRegistroEscolar' => array(self::HAS_MANY, 'SS_RequerimentoAlunoRegistroEscolar', 'SS_Requerimento_CDRequerimento'),
			'relRequerimentoAlunoTecnico' => array(self::HAS_MANY, 'SS_RequerimentoAlunoTecnico', 'SS_Requerimento_CDRequerimento'),
			'relSituacao' => array(self::MANY_MANY, 'SS_Situacao', 'SS_SituacaoRequerimento(SS_Situacao_CDSituacao, SS_Requerimento_CDRequerimento)'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('CDRequerimento',$this->CDRequerimento);

		$criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',$this->SS_ModeloRequerimento_CDModeloRequerimento);

		$criteria->compare('Aluno_CDAluno',$this->Aluno_CDAluno);

		$criteria->compare('Observacoes',$this->Observacoes,true);

		return new CActiveDataProvider('SS_Requerimento', array(
			'criteria'=>$criteria,
		));
	}
	
	// Método adicionado junto com a extensão CAdvancedArBehavior
	public function behaviors(){
	          return array( 'CAdvancedArBehavior' => array(
	            'class' => 'application.extensions.CAdvancedArBehavior'));
	}
}