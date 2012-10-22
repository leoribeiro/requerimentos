<?php

/**
 * This is the model class for table "Empresa".
 *
 * The followings are the available columns in table 'Empresa':
 * @property integer $CDEmpresa
 * @property string $NMEmpresa
 * @property string $AreaSetor
 * @property string $Responsavel
 * @property string $Telefone
 */
class Empresa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Empresa the static model class
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
		return 'Empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMEmpresa', 'required'),
			array('NMEmpresa, Responsavel', 'length', 'max'=>45),
			array('AreaSetor', 'length', 'max'=>30),
			array('Telefone', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDEmpresa, NMEmpresa, AreaSetor, Responsavel, Telefone', 'safe', 'on'=>'search'),
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
			'sS_RequerimentoAlunoEstagioEmpresas' => array(self::HAS_MANY, 'SsRequerimentoAlunoEstagioEmpresa', 'Empresa_CDEmpresa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDEmpresa' => 'Cdempresa',
			'NMEmpresa' => 'Nmempresa',
			'AreaSetor' => 'Area Setor',
			'Responsavel' => 'Responsavel',
			'Telefone' => 'Telefone',
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

		$criteria->compare('CDEmpresa',$this->CDEmpresa);

		$criteria->compare('NMEmpresa',$this->NMEmpresa,true);

		$criteria->compare('AreaSetor',$this->AreaSetor,true);

		$criteria->compare('Responsavel',$this->Responsavel,true);

		$criteria->compare('Telefone',$this->Telefone,true);

		return new CActiveDataProvider('Empresa', array(
			'criteria'=>$criteria,
		));
	}
}