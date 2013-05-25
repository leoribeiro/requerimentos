<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $configPam;
	private $users;

	public function validaAdmin(){
		$this->configPam = new ConfigApp();
		$this->users=array(
			'admin'=>$this->configPam->passAdmin,
		);
		if(isset($this->users[$this->username])){
			if($this->users[$this->username]==$this->password){
				$this->errorCode=self::ERROR_NONE;
				$roles = array('admin');
				$this->setState('roles', $roles);
				return true;
			}
			else{
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
		}
		return false;
	}

	public function regraServidor($id){

		$criteria = new CDbCriteria();
		$criteria->with = array('relModeloRequerimento');
		$criteria->distinct = true;
		$criteria->select = 'relModeloRequerimento.SgRequerimento as sgReq';
		$criteria->compare('Servidor_CDServidor',$id);
		$model = SS_ModeloRequerimentoServidor::model()->findAll($criteria);
		$reqs = array();
		foreach($model as $m){
			$reqs[] = $m->relModeloRequerimento->SgRequerimento;
		}
		$reqs = array_unique($reqs);
		return $reqs;

	}

		public function regraAluno($id){

		$criteria = new CDbCriteria();
		$criteria->compare('Aluno_CDAluno',$id);
		$model = AlunoTecnico::model()->find($criteria);
		if(is_null($model)){
			$model = AlunoGraduacao::model()->find($criteria);
			$regra = 'graduacao';
			if(is_null($model)){
				$regra = 'erro';
			}
		}
		else{
			$regra = 'tecnico';
		}
		return $regra;

	}

	public function authenticate()
	{
		$this->errorCode = self::ERROR_PASSWORD_INVALID;


		if(!$this->validaAdmin()){

			$controle = new ControleLogin();
			// Estabiliza uma conexão com o LDAP do CEFETMG
			$ds = $controle->conectaLDAP();

			if($ds){

				$boolUsuario = $controle->autenticaLDAP($ds,'servidor',
				$this->username,$this->password);
				$rule = 'servidor';
				if(!$boolUsuario){
					$boolUsuario = $controle->autenticaLDAP($ds,'aluno',
				$this->username,$this->password);
					$rule = 'aluno';
				}

				// carrega a variável com o model do usuário
				$modelUsuario = $controle->VerificaUsuarioBD($this->username);

				if($boolUsuario){
					$roles = array();
					$roles[] = $rule;

					if($modelUsuario != null){

						if($rule == 'aluno'){
							$idUsuario = 'CDAluno';
							$rules[] = $this->regraAluno($modelUsuario->$idUsuario);
							$this->errorCode = self::ERROR_NONE;

						}
						else{
							$idUsuario = 'CDServidor';
							$rg = $this->regraServidor($modelUsuario->$idUsuario);
							if(!empty($rg)){
								$this->errorCode = self::ERROR_NONE;
							}
							foreach($rg as $r){
								$roles[] = $r;
							}
						}

						$this->setState('CDUsuario', $modelUsuario->$idUsuario);
					}
					else{
						if($rule == 'aluno'){
							$this->errorCode = self::ERROR_NONE;
							$roles[] = 'novoaluno';
							$dadosAluno = $controle->VerificaDadosLDAPAluno($this->username,'mediotecnico');
							$tipoAluno = 'tecnico';
							if(is_null($dadosAluno)){
								$dadosAluno = $controle->VerificaDadosLDAPAluno($this->username,'graduacao');
								$tipoAluno = 'graduacao';
							}
							$roles[] = $tipoAluno;
							print_r($dadosAluno);exit();
							$this->setState('dadosAluno', $dadosAluno);
						}
					}
					// setando as regras do usuario
					$this->setState('roles', $roles);

				}

			}
		}
		return !$this->errorCode;
	}
}