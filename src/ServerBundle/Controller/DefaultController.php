<?php

namespace ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServerBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse;
use ServerBundle\Entity\Contato;

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
                self::insereUsuario($usuario, $nome,password_hash($senha, PASSWORD_DEFAULT), $em);
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

            $entity = $em->getRepository('ServerBundle:Usuario')->find($id);

            $em->remove($entity);
            $em->flush();

            $mensagem = "Removido com Sucesso!";
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

        $mensagem = "";
        $entity = null;
        $erro = false;
        
        $request = $this->getRequest();

        $nome = $request->request->get('nome');
        $senha = $request->request->get('senha');

        $em = $this->getDoctrine()->getEntityManager();

        if (!empty($nome) && !empty($senha)) {
            $usuario = array(
                'nome' => $nome
            );

            $entity = $em->getRepository('ServerBundle:Usuario')->findBy($usuario);
            
            $hash = $entity[0]->getSenha();
            
            if (password_verify($senha, $hash) && $entity != null) {  
                $erro = false;
            } else {
                $erro = true;
            }

        }

        $rArr = array(
            'retorno' => $entity, 'erro' => $erro, 'mensagem' => $mensagem
        );
        return new JsonResponse($rArr);
    }

    public function usuariosAction() {

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ServerBundle:Usuario')
                ->findAll();

        $rArr = array(
            'usuarios'=>$entity
        );
        
        return new JsonResponse($rArr);
    }

    public function contatoAction() {
        $retorno = false;

        $request = $this->getRequest();
        $nome = $request->request->get('nome');
        $email = $request->request->get('email');
        $assunto = $request->request->get('assunto');
        $mensagem = $request->request->get('mensagem');

        if (!empty($nome) && !empty($email) && !empty($assunto) && !empty($mensagem)) {
            $contato = new Contato();
            $em = $this->getDoctrine()->getEntityManager();

            try {
                $contato->setNomeusuario($nome);
                $contato->setAssuntousuario($assunto);
                $contato->setMensagemusuario($mensagem);
                $contato->setEmailusuario($email);

                $em->persist($contato);
                $em->flush();

                $retorno = true;
            } catch (Exception $e) {
                $e->getMessage();
                $retorno = false;
            }
        }

        $rArr = array(
            'retorno' => $retorno
        );

        return new JsonResponse($rArr);
    }

}
