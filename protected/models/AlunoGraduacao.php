<?php

/**
 * This is the model class for table "AlunoGraduacao".
 *
 * The followings are the available columns in table 'AlunoGraduacao':
 * @property integer $CDAlunoGraduacao
 * @property integer $Aluno_CDAluno
 * @property integer $CursoGraduacao_CDCurso
 */
class AlunoGraduacao extends CActiveRecord
{
	
	
	public $alunoNMAluno;
	public $alunoNumMatricula;
	public $alunoEmail;
	public $alunoCurso;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return AlunoGraduacao the static model class
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
		return 'AlunoGraduacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Aluno_CDAluno, CursoGraduacao_CDCurso,Periodo', 'required'),
			array('Aluno_CDAluno, CursoGraduacao_CDCurso,Periodo', 'numerical', 'integerOnly'=>true),
		    array('Periodo', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDAlunoGraduacao, Aluno_CDAluno, CursoGraduacao_CDCurso, alunoNumMatricula, alunoNMAluno, alunoEmail, alunoCurso', 'safe', 'on'=>'search'),
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
			'relAluno' => array(self::BELONGS_TO, 'Aluno', 'Aluno_CDAluno'),
			'relCurso' => array(self::BELONGS_TO, 'CursoGraduacao', 'CursoGraduacao_CDCurso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDAlunoGraduacao' => 'Código',
			'Aluno_CDAluno' => 'Aluno',
			'CursoGraduacao_CDCurso' => 'Curso',
			'Periodo'=>'Período',
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
		
		$criteria->with = array('relAluno','relCurso');
		
		$criteria->together = true;

		$criteria->compare('CDAlunoGraduacao',$this->CDAlunoGraduacao);

		$criteria->compare('Aluno_CDAluno',$this->Aluno_CDAluno);

		$criteria->compare('CursoGraduacao_CDCurso',$this->CursoGraduacao_CDCurso);
		
		$criteria->compare('relAluno.NMAluno',$this->alunoNMAluno, true);
		
		$criteria->compare('relAluno.NumMatricula',$this->alunoNumMatricula, true);
		
		$criteria->compare('relAluno.Email',$this->alunoEmail, true);
		
		$criteria->compare('relCurso.CDCurso',$this->alunoCurso, true);
		
		$criteria->order = 'relAluno.NMAluno';

		return new CActiveDataProvider('AlunoGraduacao', array(
			'criteria'=>$criteria,
			'pagination'=>array(
			      'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
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