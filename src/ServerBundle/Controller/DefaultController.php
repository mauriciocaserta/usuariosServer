<?php

namespace ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServerBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('ServerBundle:Default:index.html.twig', array('name' => '$name'));
    }

    public function insereUsuario($usuario, $nome, $senha, $em) {
        $usuario->setNome($nome);
        $usuario->setSenha($senha);

        $em->persist($usuario);
        $em->flush();
    }

    public function cadastroAction() {
        $retorno = false;
        $mensagem = "";

        $request = $this->getRequest();

        $nome = $request->request->get('nome');
        $senha = $request->request->get('senha');

        if (!empty($nome) || !empty($senha)) {
            $usuario = new Usuario();
            $em = $this->getDoctrine()->getManager();

            try {
                self::insereUsuario($usuario, $nome, $senha, $em);
                $retorno = true;
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

    public function loginAction() {

        $error = false;
        $mensagem = "";

        $request = $this->getRequest();

        $nome = $request->request->get('nome');
        $senha = $request->request->get('senha');

        $em = $this->getDoctrine()->getEntityManager();


        if (!empty($nome) && !empty($senha)) {
            $usuario = array(
                'nome' => $nome,
                'senha' => $senha
            );

            $entity = $em->getRepository('ServerBundle:Usuario')
                    ->findBy($usuario);

            if (!$entity) {
                $erro = true;
            } else {
                $erro = false;
            }
        }

        $rArr = array(
            'retorno' => $entity,
            'erro' => $erro,
            'mensagem' => $mensagem
        );

        return new JsonResponse($rArr);
    }

    public function usuariosAction() {

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ServerBundle:Usuario')
                ->findAll();

        return new JsonResponse($entity);
    }

}
