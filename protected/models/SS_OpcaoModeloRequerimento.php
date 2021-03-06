<?php

/**
 * This is the model class for table "SS_SituacaoRequerimento".
 *
 * The followings are the available columns in table 'SS_SituacaoRequerimento':
 * @property integer $SS_Situacao_CDSituacao
 * @property integer $SS_Requerimento_CDRequerimento
 * @property string $DataHora
 * @property string $Observacoes
 */
class SS_OpcaoModeloRequerimento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_SituacaoRequerimento the static model class
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
		return 'SS_OpcaoModeloRequerimento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SS_Opcao_CDOpcao, SS_Requerimento_CDRequerimento', 'required'),
			array('SS_Opcao_CDOpcao, SS_Requerimento_CDRequerimento,GerarRequerimentoImpresso', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SS_Opcao_CDOpcao, SS_Requerimento_CDRequerimento, DataHora,GerarRequerimentoImpresso', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SS_Opcao_CDOpcao' => 'Opção',
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

		$criteria=new CDbCriteria;

		$criteria->compare('SS_Opcao_CDOpcao',$this->SS_Opcao_CDOpcao);

		$criteria->compare('SS_Requerimento_CDRequerimento',$this->SS_Requerimento_CDRequerimento);
		
		$criteria->compare('GerarRequerimentoImpresso',$this->GerarRequerimentoImpresso);



		return new CActiveDataProvider('SS_OpcaoModeloRequerimento', array(
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