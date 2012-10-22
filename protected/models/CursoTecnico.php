<?php

/**
 * This is the model class for table "CursoTecnico".
 *
 * The followings are the available columns in table 'CursoTecnico':
 * @property integer $CDCurso
 * @property string $NMCurso
 */
class CursoTecnico extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CursoTecnico the static model class
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
		return 'CursoTecnico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMCurso', 'required'),
			array('NMCurso', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDCurso, NMCurso', 'safe', 'on'=>'search'),
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
			'alunoTecnicos' => array(self::HAS_MANY, 'AlunoTecnico', 'CursoTecnico_CDCurso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDCurso' => 'Código',
			'NMCurso' => 'Curso',
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

		$criteria->compare('CDCurso',$this->CDCurso);

		$criteria->compare('NMCurso',$this->NMCurso,true);

		return new CActiveDataProvider('CursoTecnico', array(
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