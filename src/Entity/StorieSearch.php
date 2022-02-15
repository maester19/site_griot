<?php   
namespace App\Entity;

class StorieSearch {
    /**
     * @var String|null
     */
    private $titreStorie;

    /**
     * @var String|null
     */
    private $nomAuteur;

    /**
     * Get the value of titreStorie
     *
     * @return  String|null
     */ 
    public function getTitreStorie()
    {
        return $this->titreStorie;
    }

    /**
     * Set the value of titreStorie
     *
     * @param  String|null  $titreStorie
     *
     * @return  self
     */ 
    public function setTitreStorie($titreStorie)
    {
        $this->titreStorie = $titreStorie;

        return $this;
    }

    /**
     * Get the value of nomAuteur
     *
     * @return  String|null
     */ 
    public function getNomAuteur()
    {
        return $this->nomAuteur;
    }

    /**
     * Set the value of nomAuteur
     *
     * @param  String|null  $nomAuteur
     *
     * @return  self
     */ 
    public function setNomAuteur($nomAuteur)
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }
}