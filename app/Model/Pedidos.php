<?php

namespace App\Model;

use MF\Model\Model;

class Pedidos extends Model {
	private $id;
	private $nome;
	private $telefone;
	private $solucionado;
	private $email;
    private $empresa;
    private $assunto;
    private $pergunta;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $valor){
        $this->$attr = $valor;
        return $this;
    }
    public function validaMensagem()
    {
        if (
            empty($this->email) || empty($this->assunto) ||
            empty($this->empresa) || empty($this->telefone) || empty($this->pergunta) 
        ) {
            return true; //se tudo estiver vazio retorne falso
        } else {
            return false;
        }
    }
    public function adiciona(){
        $query = "INSERT INTO tb_pedidos(nome,email,telefone,empresa,pergunta,assunto,solucionado)
        values(:nome,:email,:telefone,:empresa,:pergunta,:assunto,0)";
          echo '<pre>';
          print_r($this);
          echo '</pre>';
        $smtm = $this->db->prepare($query);
        $smtm->bindValue(':nome', $this->nome);
        $smtm->bindValue(':email', $this->email);
        $smtm->bindValue(':telefone', $this->telefone);
        $smtm->bindValue(':empresa', $this->empresa);
        $smtm->bindValue(':assunto', $this->__get('assunto'));
        $smtm->bindValue(':pergunta', $this->pergunta);
        return $smtm->execute();
    }

}