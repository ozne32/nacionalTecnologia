<?php

namespace App\Model;

use MF\Model\Model;

class Usuario extends Model {
	private $id;
    private $nome;
    private $senha; // a senha no banco de dados está registrada com um hash md5
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $valor){
        $this->$attr = $valor;
        return $this;
    }
    // verifica se usuário X existe
    public function verificaUsuario(){
        echo $this->nome;
        echo '<br>';
        echo $this->senha;
        $query = "SELECT nome, senha from tb_usuarios where nome =:nome and senha = :senha ";
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(':nome', $this->nome);
        $smtm->bindValue(':senha', $this->senha);
        $smtm->execute();
        return $smtm->fetch(\PDO::FETCH_OBJ);
    }

}