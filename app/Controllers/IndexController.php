<?php

namespace App\Controllers;

require __DIR__ . "/../PHPMailer/Exception.php";
require __DIR__ . "/../PHPMailer/SMTP.php";
require __DIR__ . "/../PHPMailer/POP3.php";
require __DIR__ . "/../PHPMailer/PHPMailer.php";
require __DIR__ . "/../PHPMailer/OAuth.php";
use MF\Controller\Action;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        if (
            empty($this->email) || empty($this->assunto) ||
            empty($this->empresa) || empty($this->telefone) || empty($this->pergunta)
        ) {
            return true; //se tudo estiver vazio retorne falso
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
        $mensagem->__set('mensagem', "<h3>Nome:$mensagem->nome</h3><h3>Email:$mensagem->email</h3><h3>Empresa: $mensagem->empresa</h3>
         <h3>Pergunta:</h3> <h2>$mensagem->pergunta</h2> <h3>Telefone:</h3><strong>$mensagem->telefone</strong>");

        if ($mensagem->validaMensagem()) {
            //die(); //função nativa do php que mata o processo da aplicação
            header('location:/contactus?preenchimento=erro');
            // echo '<pre>';
            // print_r($mensagem);
            // echo '</pre>';
        } else {
            if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                try {
                    $mail = new PHPMailer(true);//precisa gerar um objeto, pq se não daonde ia estar saindo tudo dps ?
                    //Server settings -> email que você vai usar como servidor
                    $mail->SMTPDebug = false;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                    $mail->Username = 'email.com';                     //SMTP username
                    $mail->Password = 'senha1234';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                    // echo '<pre>';
                    // print_r($mail);
                    // echo '</pre>';            

                    //Recipients -> remetente
                    $mail->setFrom('enzorcc.mf3rs@gmail.com', 'enzo'); //remetente
                    $mail->addAddress('enzorcc.mf3rs@gmail.com');
                    // $mail->addAddress($mensagem->__get('email'), 'Seu email já foi encaminhado para a assistência tecnica');     //destinatário
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
                    $mail->AltBody = strip_tags($mensagem->__get('mensagem'));
                    $mail->send();
                    // $mail->AltBody = "Nome:$mensagem->nome  Email:$mensagem->email Empresa: $mensagem->empresa 
                    // Pergunta: $mensagem->pergunta Telefone: $mensagem->telefone";
                    // $mail->send();
                    $mensagem->__set("status['codigo_status']", 1);
                    $mensagem->__set("status['descricao_status']", 'sua mensagem foi enviada');

                    header('location: /contactus?mensagem=enviada');
                } catch (Exception $e) {
                    $mensagem->__set("status['codigo_status']", 2);
                    $mensagem->__set("status['descricao_status']", 'Sua mensagem não foi mandada. Detalhes sobre o erro ' . $mail->ErrorInfo);
                }
            }else{
                header('location:/contactus?preenchimento=erroEmail');
            }
        }
    }
}
//importacao das bibliotecas
//definindo os atachments para não ter problemas de nomes repetidos e etc


