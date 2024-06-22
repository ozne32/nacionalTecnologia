<?php

namespace App\Controllers;

use MF\Controller\Action;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mensagem
{
    private $nome = null;
    private $email = null;
    private $telefone = null;
    private $empresa = null;
    private $assunto = null;
    private $pergunta = null;
    private $mensagem = null;
    private $status = array('codigo_status' => null, 'descricao_status' => null);
    public function __get($attr)
    {
        return $this->$attr;
    }
    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
    public function validaMensagem()
    {
        if ($this->destino != null && $this->assunto != null && $this->mensagem != null) {
            return true;
        } else {
            return false;
        }
    }
}
class IndexController extends Action
{
    public function index()
    {
        $this->render('index');
    }
    public function planos()
    {
        $this->render('planos');
    }
    public function contato()
    {
        $this->render('contactus');
    }
    public function sobre()
    {
        $this->render('empresa');
    }
    public function mandaEmail()
    {
        $mensagem = new Mensagem();
        $mensagem->__set('nome', $_POST['nome']);
        $mensagem->__set('email', $_POST['email']);
        $mensagem->__set('telefone', $_POST['telefone']);
        $mensagem->__set('empresa', $_POST['empresa']);
        $mensagem->__set('assunto', $_POST['assunto']);
        $mensagem->__set('pergunta', $_POST['pergunta']);
        $mensagem->__set('mensagem', "<h3>Nome:$mensagem->nome</h3> <br> <h3>Email:$mensagem->email</h3> <br> <p>Empresa: $mensagem->empresa</p> <br>
        <p>Assunto: $mensagem->assunto</p> <br> <p>Pergunta: $mensagem->pergunta</p> <br> <p>Telefone: $mensagem->telefone</p> <br>");

        if (!$mensagem->validaMensagem()) {
            echo 'mensagem inválidada';
            //die(); //função nativa do php que mata o processo da aplicação
            header('location: index.php?preenchimento=erro');
        }

        try {
           
            //Recipients -> remetente
            $mail->setFrom($mensagem->__get('destino'), $mensagem->__get('nome'));
            $mail->addAddress($mensagem->__get('destino'));     //Add a recipient
            // $mail->addReplyTo('info@example.com', 'Information'); isso é o email que vai receber a resposta do email acima
            //$mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $mensagem->__get('assunto');
            $mail->Body = $mensagem->__get('mensagem');
            $mail->AltBody = 'é necessário que você tenha a opção de ver conteúdo HTML, para você conseguir ter acesso total à este conteúdo';

            $mail->send();
            $mensagem->__set("status['codigo_status']", 1);
            $mensagem->__set("status['descricao_status']", 'sua mensagem foi enviada');
        } catch (Exception $e) {
            $mensagem->__set("status['codigo_status']", 2);
            $mensagem->__set("status['descricao_status']", 'Sua mensagem não foi mandada. Detalhes sobre o erro ' . $mail->ErrorInfo);
        }
    }
}
//importacao das bibliotecas
//definindo os atachments para não ter problemas de nomes repetidos e etc


