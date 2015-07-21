<?php

namespace ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServerBundle\Entity\Usuario;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('ServerBundle:Default:index.html.twig', array('name' => $name));
    }

    public function cadastroAction() {       
        $retorno = false;
        $mensagem = "";
        
        $request = $this->getRequest();

        $nome = $request->get('nome');
        $senha = $request->get('senha');

        if (!empty($nome) || !empty($senha)) {
            $usuario = new Usuario();
            $em = $this->getDoctrine()->getManager();

            try {
              $usuario->setNome($nome);
              $usuario->setSenha($senha);
              
              $em->persist($usuario);
              $em->flush();
              
              $retorno = true;
              $mensagem = "Usuario Inserido!";
            } catch (Exception $e) {
                $mensagem = $e->getMessage();
                $retorno = false;
            }
        }
        
        $rArr = array(
            'retorno'=>$retorno
            );
        
        return new JsonResponse($rArr);
    }

}
