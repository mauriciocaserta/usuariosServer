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
            'retorno' => $retorno
        );

        return new JsonResponse($rArr);
    }

    public function deleteAction() {
        $mensagem = "";
        $retorno = false;

        $request = $this->getRequest();

        $id = $request->request->get('id');

        try {
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('ServerBundle:Usuario')->find('id');

            $em->remove($entity);
            $em->flush();

            $mensagem = "Deletado com Sucesso!";
            $retorno = true;
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
            $retorno = false;
        }

        $rArr = array(
            'mensagem' => $mensagem,
            'retorno' => $retorno
        );

        return new JsonResponse($rArr);
    }

}
