<?php 
class WebUser extends CWebUser
{
    public $permRR;
    public $permRT;
    public $permRG;
    public $permRE;
    public $permRF;
    public $CDUsuario;
    public $NMUsuario;
    public $rightsReturnUrl;

    public function getCDUsuario(){
        return Yii::app()->getSession()->get('CDUsuario');
    }

    public function getRightsReturnUrl(){
        return $this->rightsReturnUrl;
    }

    public function getNMUsuario(){
        return Yii::app()->getSession()->get('NMUsuario');
    }

    public function getPermRR(){
        return Yii::app()->getSession()->get('permRR');
    }

    public function getPermRT(){
        return Yii::app()->getSession()->get('permRT');
    }

    public function getPermRG(){
        return Yii::app()->getSession()->get('permRG');
    }

    public function getPermRF(){
        return Yii::app()->getSession()->get('permRF');
    }

    public function getPermRE(){
        return Yii::app()->getSession()->get('permRE');
    }

    public function getModelServidor()
    {
        return Yii::app()->getSession()->get('modelServidor');
    }

    public function getModelAluno()
    {
        return Yii::app()->getSession()->get('modelAluno');
    }

    public function setModelAluno($modelAluno)
    {
        Yii::app()->getSession()->add('modelAluno', $modelAluno);

        Yii::app()->getSession()->add('CDUsuario',
        $this->getModelAluno()->CDAluno);

        Yii::app()->getSession()->add('NMUsuario',
        $this->getModelAluno()->NMAluno);
    }

    public function getModelProfessor()
    {
        return Yii::app()->getSession()->get('modelProfessor');
    }

    public function getTipoAluno()
    {

        if(!is_null($this->getModelAluno())){

                if(!isset($this->getModelAluno()->CDAluno)){
                    return 0;
                }

                $criteria = new CDbCriteria;    $criteria->compare('Aluno_CDAluno',$this->getModelAluno()->CDAluno);
                $modelAlunoTecnico  = AlunoTecnico::model()->find($criteria);

                if(!is_null($modelAlunoTecnico)){
                    return 1;
                }

                $criteria = new CDbCriteria;
            $criteria->compare('Aluno_CDAluno',$this->getModelAluno()->CDAluno);
                $modelAlunoGraduacao = AlunoGraduacao::model()->find($criteria);

                if(!is_null($modelAlunoGraduacao)){
                    return 2;
                }
        }


        return 0;
    }

    // public function login($identity, $duration)
    // {
    //     parent::login($identity, $duration);
    //     Yii::app()->getSession()->add('modelServidor', $identity->getModelServidor());
    //     Yii::app()->getSession()->add('modelAluno', $identity->getModelAluno());
    //     Yii::app()->getSession()->add('modelProfessor', $identity->getModelProfessor());

    //     Yii::app()->getSession()->add('CDUsuario','admin');
    //     Yii::app()->getSession()->add('NMUsuario','admin');

    //     if(!is_null($identity->getModelServidor())){

    //         Yii::app()->getSession()->add('CDUsuario',
    //         $identity->getModelServidor()->CDServidor);

    //         Yii::app()->getSession()->add('NMUsuario',
    //         $identity->getModelServidor()->NMServidor);
    //     }

    //     if(!is_null($identity->getModelAluno())){

    //         if(isset($identity->getModelAluno()->CDAluno))
    //             Yii::app()->getSession()->add('CDUsuario',
    //             $identity->getModelAluno()->CDAluno);

    //         if(isset($identity->getModelAluno()->NMAluno))
    //             Yii::app()->getSession()->add('NMUsuario',
    //             $identity->getModelAluno()->NMAluno);
    //     }
    // }

    public function logout($destroySession= true)
    {
        parent::logout($destroySession);
        // I always remove the session variable model.
        Yii::app()->getSession()->remove('modelServidor');
        Yii::app()->getSession()->remove('modelAluno');
        Yii::app()->getSession()->remove('modelProfessor');
        Yii::app()->getSession()->remove('CDUsuario');
        Yii::app()->getSession()->remove('NMUsuario');
    }

    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights

            return false;
        }

        $roles = $this->getState('roles');

        foreach($roles as $role){
            // if ($role === 'admin') {
            //     return true; // admin role has access to everything
            // }
            // allow access if the operation request is the current user's role
            if($role === $operation){
                return true;
            }
        }
        return false;
    }
}