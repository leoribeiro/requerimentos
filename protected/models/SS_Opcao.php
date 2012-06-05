<?php

/**
 * This is the model class for table "SS_Opcao".
 *
 * The followings are the available columns in table 'SS_Opcao':
 * @property integer $CDOpcao
 * @property string $NMOpcao
 */
class SS_Opcao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_Opcao the static model class
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
		return 'SS_Opcao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMOpcao', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDOpcao, NMOpcao', 'safe', 'on'=>'search'),
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
			'relModeloRequerimento' => array(self::MANY_MANY, 'SS_ModeloRequerimento', 'SS_OpcaoModeloRequerimento(SS_Opcao_CDOpcao, SS_Requerimento_CDRequerimento)'),
			'relRequerimento' => array(self::MANY_MANY, 'SS_Requerimento', 'SS_OpcaoRequerimento(SS_Opcao_CDOpcao, SS_Requerimento_CDRequerimento)'),
			
			
			// Situação interessante, para usar campos da tabela gerada
			// no relacionamento N to N
			'Opcao_ModeloRequerimento' => array(self::HAS_MANY, 'SS_OpcaoModeloRequerimento', 'SS_Opcao_CDOpcao'),
			'ModeloRequerimento' => array(self::HAS_MANY, 'SS_ModeloRequerimento', 'SS_Requerimento_CDRequerimento', 'through' => 'Opcao_ModeloRequerimento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDOpcao' => 'Código',
			'NMOpcao' => 'Opção',
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

		$criteria->compare('CDOpcao',$this->CDOpcao);

		$criteria->compare('NMOpcao',$this->NMOpcao,true);

		return new CActiveDataProvider('SS_Opcao', array(
			'criteria'=>$criteria,
		));
	}
	
	public function behaviors()
	{
	    return array(
	        'LoggableBehavior'=>
	            'application.modules.auditTrail.behaviors.LoggableBehavior',
	    );
	}
	
}