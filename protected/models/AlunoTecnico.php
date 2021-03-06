<?php

/**
 * This is the model class for table "AlunoTecnico".
 *
 * The followings are the available columns in table 'AlunoTecnico':
 * @property integer $CDAlunoTecnico
 * @property integer $Aluno_CDAluno
 * @property integer $CursoTecnico_CDCurso
 * @property integer $Serie
 */
class AlunoTecnico extends CActiveRecord
{
	
	public $alunoNMAluno;
	public $alunoNumMatricula;
	public $alunoEmail;
	public $alunoCurso;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return AlunoTecnico the static model class
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
		return 'AlunoTecnico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Aluno_CDAluno, CursoTecnico_CDCurso, Turma_CDTurma', 'required'),
			array('Aluno_CDAluno, CursoTecnico_CDCurso, Turma_CDTurma, Serie', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDAlunoTecnico, Aluno_CDAluno, CursoTecnico_CDCurso, Serie, alunoNumMatricula, alunoNMAluno, alunoEmail, alunoCurso', 'safe', 'on'=>'search'),
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
			'relCurso' => array(self::BELONGS_TO, 'CursoTecnico', 'CursoTecnico_CDCurso'),
			'relTurma' => array(self::BELONGS_TO, 'Turma', 'Turma_CDTurma'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDAlunoTecnico' => 'Código',
			'Aluno_CDAluno' => 'Aluno',
			'CursoTecnico_CDCurso' => 'Curso',
			'Serie' => 'Série',
			'Turma_CDTurma' => 'Turma',
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

		$criteria->compare('CDAlunoTecnico',$this->CDAlunoTecnico);

		$criteria->compare('Aluno_CDAluno',$this->Aluno_CDAluno);

		$criteria->compare('CursoTecnico_CDCurso',$this->CursoTecnico_CDCurso);

		$criteria->compare('Serie',$this->Serie);
		
		$criteria->compare('relAluno.NMAluno',$this->alunoNMAluno, true);
		
		$criteria->compare('relAluno.NumMatricula',$this->alunoNumMatricula, true);
		
		$criteria->compare('relAluno.Email',$this->alunoEmail, true);
		
		$criteria->compare('relCurso.CDCurso',$this->alunoCurso, true);
		
		$criteria->order = 'relAluno.NMAluno';

		return new CActiveDataProvider('AlunoTecnico', array(
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