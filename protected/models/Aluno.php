<?php

/**
 * This is the model class for table "Aluno".
 *
 * The followings are the available columns in table 'Aluno':
 * @property integer $CDAluno
 * @property string $NMAluno
 * @property string $NumMatricula
 * @property string $Bairro
 * @property string $CEP
 * @property string $EnderecoRua
 * @property string $EnderecoNumero
 * @property string $Email
 * @property string $Telefone
 * @property string $DataNascimento
 * @property string $Sexo
 */
class Aluno extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Aluno the static model class
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
		return 'Aluno';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NMAluno, Email', 'required'),
			array('CEP,EnderecoNumero,NumMatricula,Cidade_CDCidade', 'numerical', 'integerOnly'=>true),
			array('Email', 'email'),
			array('NMAluno, Email', 'length', 'max'=>45),
			array('NumMatricula', 'length', 'max'=>12),
			array('Bairro', 'length', 'max'=>25),
			array('CEP', 'length', 'max'=>8),
			array('EnderecoRua', 'length', 'max'=>30),
			array('EnderecoNumero', 'length', 'max'=>7),
			array('Telefone', 'length', 'max'=>10),
			array('Sexo', 'length', 'max'=>1),
			array('DataNascimento', 'safe'),
			array('NumMatricula', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDAluno, NMAluno, NumMatricula, Bairro, CEP, EnderecoRua, EnderecoNumero, Email, Telefone, DataNascimento, Sexo,Cidade_CDCidade', 'safe', 'on'=>'search'),
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
			'relAlunoGraduacao' => array(self::HAS_MANY, 'AlunoGraduacao', 'Aluno_CDAluno'),
			'relAlunoTecnico' => array(self::HAS_MANY, 'AlunoTecnico', 'Aluno_CDAluno'),
			'sS_Requerimentos' => array(self::HAS_MANY, 'SsRequerimento', 'Aluno_CDAluno'),
			'senhaAlunos' => array(self::HAS_MANY, 'SenhaAluno', 'Aluno_CDAluno'),
			'relCidade' => array(self::BELONGS_TO, 'Cidade', 'Cidade_CDCidade'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDAluno' => 'Código',
			'NMAluno' => 'Nome',
			'NumMatricula' => 'Matricula',
			'Bairro' => 'Bairro',
			'CEP' => 'Cep',
			'EnderecoRua' => 'Rua',
			'EnderecoNumero' => 'Número',
			'Email' => 'Email',
			'Telefone' => 'Telefone',
			'DataNascimento' => 'Data de Nascimento',
			'Sexo' => 'Sexo',
			'Cidade_CDCidade' => 'Cidade',
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

		$criteria->compare('CDAluno',$this->CDAluno);

		$criteria->compare('NMAluno',$this->NMAluno,true);

		$criteria->compare('NumMatricula',$this->NumMatricula,true);

		$criteria->compare('Bairro',$this->Bairro,true);

		$criteria->compare('CEP',$this->CEP,true);

		$criteria->compare('EnderecoRua',$this->EnderecoRua,true);

		$criteria->compare('EnderecoNumero',$this->EnderecoNumero,true);

		$criteria->compare('Email',$this->Email,true);

		$criteria->compare('Telefone',$this->Telefone,true);

		$criteria->compare('DataNascimento',$this->DataNascimento,true);

		$criteria->compare('Sexo',$this->Sexo,true);

		return new CActiveDataProvider('Aluno', array(
			'criteria'=>$criteria,
		));
	}
	
	public function behaviors()
	{
	    return array(
			
			// Adicionado junto com a extensão CAdvancedArBehavior
			'CAdvancedArBehavior' => array('class' => 'application.extensions.CAdvancedArBehavior'),
			
		    // 'ext' is in Yii 1.0.8 version. For early versions, use 'application.extensions' instead.
			'datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior'),
			
			

			
		); 

	}
	
}