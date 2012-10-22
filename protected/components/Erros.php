<?php
class Erros {

    static function trataErro($error) {

        switch($error['code']){
            case 404: $error['message'] = 'A página requisitada não existe.'; break;
            case 500: $error['message'] = 'Este registro possui referências, delete-as para que esta operação seja possível.'; break;
        }
        
        return $error;
    }

}
?>