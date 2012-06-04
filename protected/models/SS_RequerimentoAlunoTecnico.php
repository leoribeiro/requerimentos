<?php

/**
 * This is the model class for table "SS_RequerimentoAlunoTecnico".
 *
 * The followings are the available columns in table 'SS_RequerimentoAlunoTecnico':
 * @property integer $CDRequerimentoAlunoTecnico
 * @property string $Ano
 * @property integer $SS_Requerimento_CDRequerimento
 */
class SS_RequerimentoAlunoTecnico extends CActiveRecord
{
	public $SgReq = "RT";
	public $NumRequerimento;
	public $Situacao;
	public $DtPedido;
	public $nomeAluno;
	/**
	 * Returns the static model of the specified AR class.
	 * @return SS_RequerimentoAlunoTecnico the static model class
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
		return 'SS_RequerimentoAlunoTecnico';
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
			array('CDRequerimentoAlunoTecnico, Ano, SS_Requerimento_CDRequerimento', 'safe', 'on'=>'search'),
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
			'relRequerimento' => array(self::BELONGS_TO, 'SS_Requerimento', 'SS_Requerimento_CDRequerimento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDRequerimentoAlunoTecnico' => 'Cdrequerimento Aluno Tecnico',
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
		$parametros = func_get_args();

		$criteria=new CDbCriteria;
		$criteria->with = array('relRequerimento');
		$criteria->together = true;
		
		if(isset($parametros[0])){
			$criteria->compare('relRequerimento.Aluno_CDAluno',
			Yii::app()->user->getModelAluno()->CDAluno);
		}
		
		if(!is_null(Yii::app()->user->getModelServidor())){
			if(Yii::app()->user->getPermRT()){
				$criteriaS=new CDbCriteria;
				$criteriaS->compare('Servidor_CDServidor',
				Yii::app()->user->getModelServidor()->CDServidor);
				$criteriaS->addCondition('CursoTecnico_CDCurso IS NOT NULL');
				// define essa regra apenas para o curso técnico
				$criteriaS->compare('SS_ModeloRequerimento_CDModeloRequerimento',2);
				$modelsMRS =SS_ModeloRequerimentoServidor::model()->findAll($criteriaS);
				$cursos = array();
				foreach($modelsMRS as $model){
					$cursos[] = (int)$model->CursoTecnico_CDCurso;
				}
				$cursos = array_unique($cursos);
				
				$criteriaS=new CDbCriteria;
				$criteriaS->addInCondition('CursoTecnico_CDCurso',$cursos);
				$modelsA =AlunoTecnico::model()->findAll($criteriaS);
				
				$alunos = array();
				foreach($modelsA as $model){
					$alunos[] = (int)$model->Aluno_CDAluno;
				}
				$criteria->addInCondition('relRequerimento.Aluno_CDAluno',$alunos);
			}
		}

		$criteria->compare('CDRequerimentoAlunoTecnico',$this->CDRequerimentoAlunoTecnico);

		$criteria->compare('Ano',$this->Ano,true);

		$criteria->compare('SS_Requerimento_CDRequerimento',$this->SS_Requerimento_CDRequerimento);
		
		$criteria->order = 'CDRequerimentoAlunoTecnico DESC'; 

		return new CActiveDataProvider('SS_RequerimentoAlunoTecnico', array(
			'criteria'=>$criteria,
		));
	}

	public function scopes()
	{
	    return array(
	        'lastRecord'=>array(
	            //'condition'=>'',
	            'order'=>'CDRequerimentoAlunoTecnico DESC',
	            'limit'=>1,
	        ),
	    );
	}
	
	public function getLastRecord(){
       $registro = SS_RequerimentoAlunoTecnico::model()->lastRecord()->find();
	   if(is_null($registro)){
		return 0;
	   }
       return $registro->CDRequerimentoAlunoTecnico;
	}
	
	public function getNumRequerimento(){
	       return ($this->SgReq . str_pad($this->CDRequerimentoAlunoTecnico, 4, "0", STR_PAD_LEFT) . "/" . $this->Ano);
	 }
	
}