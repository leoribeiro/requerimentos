<?php

/**
 * This is the model class for table "SS_ModeloRequerimento".
 *
 * The followings are the available columns in table 'SS_ModeloRequerimento':
 * @property integer $CDModeloRequerimento
 * @property string $NMModeloRequerimento
 */
class SS_ModeloRequerimento extends CActiveRecord
{
	
	public $Opcoes;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_ModeloRequerimento the static model class
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
		return 'SS_ModeloRequerimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMModeloRequerimento,SgRequerimento', 'required'),
			array('NMModeloRequerimento', 'length', 'max'=>60),
			array('SgRequerimento', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDModeloRequerimento, NMModeloRequerimento', 'safe', 'on'=>'search'),
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
			'relOpcao' => array(self::MANY_MANY, 'SS_Opcao', 'SS_OpcaoModeloRequerimento(SS_Requerimento_CDRequerimento,SS_Opcao_CDOpcao)'),
			'relRequerimento' => array(self::HAS_MANY, 'SS_Requerimento', 'SS_ModeloRequerimento_CDModeloRequerimento'),
			
			
			
			// Situação interessante, para usar campos da tabela gerada
			// no relacionamento N to N
			'Opcao_ModeloRequerimento' => array(self::HAS_MANY, 'SS_OpcaoModeloRequerimento', 'SS_Requerimento_CDRequerimento'),
			'Opcao' => array(self::HAS_MANY, 'SS_Opcao', 'SS_Opcao_CDOpcao', 'through' => 'Opcao_ModeloRequerimento'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDModeloRequerimento' => 'Código',
			'NMModeloRequerimento' => 'Requerimento',
			'SgRequerimento' => 'Sigla',
			'relOpcao' => 'Opções escolhidas',
			'Relatorio' => 'Gerar Requerimento em PDF',
			'OpcoesDisponiveis' => 'Opções disponíveis',
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

		$criteria->compare('CDModeloRequerimento',$this->CDModeloRequerimento);

		$criteria->compare('NMModeloRequerimento',$this->NMModeloRequerimento,true);

$criteria->compare('SgRequerimento',$this->SgRequerimento,true);

		return new CActiveDataProvider('SS_ModeloRequerimento', array(
			'criteria'=>$criteria,
		));
	}
	
	// Método adicionado junto com a extensão CAdvancedArBehavior
	public function behaviors(){
	          return array( 'CAdvancedArBehavior' => array(
	            'class' => 'application.extensions.CAdvancedArBehavior'));
	}
	
	public function getTotal(){
	   $criteria = new CDbCriteria;
	   $criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',
	   $this->CDModeloRequerimento);
	   $criteria->select = 'COUNT(CDRequerimento) as TotalReq';
	   $criteria->group = 'SS_ModeloRequerimento_CDModeloRequerimento';
	   $registro = SS_Requerimento::model()->find($criteria);
	   //print_r($registro);
	//echo "<br / >".$registro->TotalReq;
	//exit();
	   return $registro->TotalReq;
	
	   
	}
	
}