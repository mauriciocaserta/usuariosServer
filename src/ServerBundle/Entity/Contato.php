<?php

namespace ServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contato
 */
class Contato
{
    /**
     * @var string
     */
    private $nomeusuario;

    /**
     * @var string
     */
    private $emailusuario;

    /**
     * @var string
     */
    private $assuntousuario;

    /**
     * @var string
     */
    private $mensagemusuario;

    /**
     * @var integer
     */
    private $idusuario;


    /**
     * Set nomeusuario
     *
     * @param string $nomeusuario
     * @return Contato
     */
    public function setNomeusuario($nomeusuario)
    {
        $this->nomeusuario = $nomeusuario;

        return $this;
    }

    /**
     * Get nomeusuario
     *
     * @return string 
     */
    public function getNomeusuario()
    {
        return $this->nomeusuario;
    }

    /**
     * Set emailusuario
     *
     * @param string $emailusuario
     * @return Contato
     */
    public function setEmailusuario($emailusuario)
    {
        $this->emailusuario = $emailusuario;

        return $this;
    }

    /**
     * Get emailusuario
     *
     * @return string 
     */
    public function getEmailusuario()
    {
        return $this->emailusuario;
    }

    /**
     * Set assuntousuario
     *
     * @param string $assuntousuario
     * @return Contato
     */
    public function setAssuntousuario($assuntousuario)
    {
        $this->assuntousuario = $assuntousuario;

        return $this;
    }

    /**
     * Get assuntousuario
     *
     * @return string 
     */
    public function getAssuntousuario()
    {
        return $this->assuntousuario;
    }

    /**
     * Set mensagemusuario
     *
     * @param string $mensagemusuario
     * @return Contato
     */
    public function setMensagemusuario($mensagemusuario)
    {
        $this->mensagemusuario = $mensagemusuario;

        return $this;
    }

    /**
     * Get mensagemusuario
     *
     * @return string 
     */
    public function getMensagemusuario()
    {
        return $this->mensagemusuario;
    }

    /**
     * Get idusuario
     *
     * @return integer 
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}
