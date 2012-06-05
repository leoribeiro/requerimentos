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
	public $servidorNMServidor;
	public $cursoTecnicoNMCurso;
	public $cursoGraduacaoNMCurso;
	public $reqNMRequerimento;
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
			array('SS_ModeloRequerimento_CDModeloRequerimento, Servidor_CDServidor, CursoTecnico_CDCurso, CursoGraduacao_CDCurso, servidorNMServidor, cursoTecnicoNMCurso, cursoGraduacaoNMCurso, reqNMRequerimento', 'safe', 'on'=>'search'),
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
			'relModeloRequerimento' => array(self::BELONGS_TO, 'SS_ModeloRequerimento', 'SS_ModeloRequerimento_CDModeloRequerimento'),
			'relServidor' => array(self::BELONGS_TO, 'Servidor', 'Servidor_CDServidor'),
			'relCursoTecnico' => array(self::BELONGS_TO, 'CursoTecnico', 'CursoTecnico_CDCurso'),
			'relCursoGraduacao' => array(self::BELONGS_TO, 'CursoGraduacao', 'CursoGraduacao_CDCurso'),
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
		
		$criteria->with = array('relCursoTecnico','relCursoGraduacao',
		'relServidor','relModeloRequerimento');
		
		$criteria->together = true;
		$criteria->compare('SS_ModeloRequerimento_CDModeloRequerimento',$this->SS_ModeloRequerimento_CDModeloRequerimento);

		$criteria->compare('Servidor_CDServidor',$this->Servidor_CDServidor);

		$criteria->compare('CursoTecnico_CDCurso',$this->CursoTecnico_CDCurso);
		
		$criteria->compare('relModeloRequerimento.NMModeloRequerimento',
		$this->reqNMRequerimento, true);
		
		$criteria->compare('relCursoTecnico.NMCurso',
		$this->cursoTecnicoNMCurso, true);
		
		$criteria->compare('relCursoGraduacao.NMCurso',
		$this->cursoGraduacaoNMCurso, true);
		
		$criteria->compare('relServidor.NMServidor',
		$this->servidorNMServidor, true);

		$criteria->compare('CursoGraduacao_CDCurso',$this->CursoGraduacao_CDCurso);

		return new CActiveDataProvider('SS_ModeloRequerimentoServidor', array(
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