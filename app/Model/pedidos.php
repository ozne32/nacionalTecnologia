<?php

namespace App\Models;

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

}