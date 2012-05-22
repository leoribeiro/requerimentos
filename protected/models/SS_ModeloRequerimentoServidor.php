<?php

/**
 * This is the model class for table "SS_ModeloRequerimentoServidor".
 *
 * The followings are the available columns in table 'SS_ModeloRequerimentoServidor':
 * @property integer $SS_ModeloRequerimento_CDModeloRequerimento
 * @property integer $Servidor_CDServidor
 * @property integer $Curso_CDCurso
 */
class SS_ModeloRequerimentoServidor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_ModeloRequerimentoServidor the static model class
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
		return 'SS_ModeloRequerimentoServidor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SS_ModeloRequerimento_CDModeloRequerimento, Servidor_CDServidor', 'required'),
			array('SS_ModeloRequerimento_CDModeloRequerimento, Servidor_CDServidor, CursoTecnico_CDCurso, CursoGraduacao_CDCurso', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SS_ModeloRequerimento_CDModeloRequerimento, Servidor_CDServidor, CursoTecnico_CDCurso, CursoGraduacao_CDCurso', 'safe', 'on'=>'search'),
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
			'SS_ModeloRequerimento_CDModeloRequerimento' => 'Modelo de Requerimento',
			'Servidor_CDServidor' => 'Servidor',
			'CursoTecnico_CDCurso' => 'Curso técnico',
			'CursoGraduacao_CDCurso' => 'Curso de graduação',
			'ServEscolhido' => 'Servidores selecionados',
			'Servidores' => 'Servidores',
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

		$criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',$this->SS_ModeloRequerimento_CDModeloRequerimento);

		$criteria->compare('Servidor_CDServidor',$this->Servidor_CDServidor);

		$criteria->compare('CursoTecnico_CDCurso',$this->CursoTecnico_CDCurso);

		$criteria->compare('CursoGraduacao_CDCurso',$this->CursoGraduacao_CDCurso);

		return new CActiveDataProvider('SS_ModeloRequerimentoServidor', array(
			'criteria'=>$criteria,
		));
	}
}