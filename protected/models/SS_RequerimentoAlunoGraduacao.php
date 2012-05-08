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
			array('CDRequerimentoAlunoGraduacao, Ano, SS_Requerimento_CDRequerimento', 'safe', 'on'=>'search'),
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
			'sS_Requerimento_CDRequerimento' => array(self::BELONGS_TO, 'SsRequerimento', 'SS_Requerimento_CDRequerimento'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('CDRequerimentoAlunoGraduacao',$this->CDRequerimentoAlunoGraduacao);

		$criteria->compare('Ano',$this->Ano,true);

		$criteria->compare('SS_Requerimento_CDRequerimento',$this->SS_Requerimento_CDRequerimento);

		return new CActiveDataProvider('SS_RequerimentoAlunoGraduacao', array(
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
	
}