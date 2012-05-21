<?php

/**
 * This is the model class for table "SS_Situacao".
 *
 * The followings are the available columns in table 'SS_Situacao':
 * @property integer $CDSituacao
 * @property string $NMsituacao
 */
class SS_Situacao extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_Situacao the static model class
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
		return 'SS_Situacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMsituacao', 'required'),
			array('NMsituacao', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDSituacao, NMsituacao', 'safe', 'on'=>'search'),
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
			'relRequerimento' => array(self::MANY_MANY, 'SS_Requerimento', 'SS_SituacaoRequerimento(SS_Situacao_CDSituacao, SS_Requerimento_CDRequerimento)'),
			
			// Situação interessante, para usar campos da tabela gerada
			// no relacionamento N to N
			'Situacao_Requerimento' => array(self::HAS_MANY, 'SS_SituacaoRequerimento', 'SS_Situacao_CDSituacao'),
			'Requerimento' => array(self::HAS_MANY, 'SS_Requerimento', 'SS_Requerimento_CDRequerimento', 'through' => 'Situacao_Requerimento'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDSituacao' => 'Código',
			'NMsituacao' => 'Situação',
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

		$criteria->compare('CDSituacao',$this->CDSituacao);

		$criteria->compare('NMsituacao',$this->NMsituacao,true);

		return new CActiveDataProvider('SS_Situacao', array(
			'criteria'=>$criteria,
		));
	}
}