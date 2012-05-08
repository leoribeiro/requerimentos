<?php

/**
 * This is the model class for table "SS_RequerimentoAlunoEstagioEmpresa".
 *
 * The followings are the available columns in table 'SS_RequerimentoAlunoEstagioEmpresa':
 * @property integer $SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio
 * @property string $SS_RequerimentoAlunoEstagio_Ano
 * @property integer $Empresa_CDEmpresa
 */
class SS_RequerimentoAlunoEstagioEmpresa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_RequerimentoAlunoEstagioEmpresa the static model class
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
		return 'SS_RequerimentoAlunoEstagioEmpresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio, SS_RequerimentoAlunoEstagio_Ano, Empresa_CDEmpresa', 'required'),
			array('SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio, Empresa_CDEmpresa', 'numerical', 'integerOnly'=>true),
			array('SS_RequerimentoAlunoEstagio_Ano', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio, SS_RequerimentoAlunoEstagio_Ano, Empresa_CDEmpresa', 'safe', 'on'=>'search'),
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
			'sS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio' => array(self::BELONGS_TO, 'SsRequerimentoAlunoEstagio', 'SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio'),
			'sS_RequerimentoAlunoEstagio_Ano' => array(self::BELONGS_TO, 'SsRequerimentoAlunoEstagio', 'SS_RequerimentoAlunoEstagio_Ano'),
			'empresa_CDEmpresa' => array(self::BELONGS_TO, 'Empresa', 'Empresa_CDEmpresa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio' => 'Ss Requerimento Aluno Estagio Cdrequerimento Aluno Estagio',
			'SS_RequerimentoAlunoEstagio_Ano' => 'Ss Requerimento Aluno Estagio Ano',
			'Empresa_CDEmpresa' => 'Empresa Cdempresa',
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

		$criteria->compare('SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio',$this->SS_RequerimentoAlunoEstagio_CDRequerimentoAlunoEstagio);

		$criteria->compare('SS_RequerimentoAlunoEstagio_Ano',$this->SS_RequerimentoAlunoEstagio_Ano,true);

		$criteria->compare('Empresa_CDEmpresa',$this->Empresa_CDEmpresa);

		return new CActiveDataProvider('SS_RequerimentoAlunoEstagioEmpresa', array(
			'criteria'=>$criteria,
		));
	}
}