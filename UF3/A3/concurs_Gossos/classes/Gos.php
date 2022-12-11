<?php
    class Gos {
        //PROPIETATS
        //private: només permet accedir-hi des de la pròpia classe
        private $nom;
        private $amo;
        private $imatge;
        private $raca;
        private $punts;

        //CONSTRUCTOR: s'executa quan es crea l'objecte
        public function __construct($nom, $amo, $imatge, $raca, $punts)
        {
            $this->nom = $nom;
            $this->imatge = $imatge;
            $this->amo = $amo;
            $this->raca = $raca;
            $this->punts = $punts;
        }
        
        //MÈTODES
        public function getNom()
        {
            return $this->nom;
        }
        public function getImatge()
        {
            return $this->imatge;
        }   
        public function getAmo()
        {
            return $this->amo;
        }
        public function getRaca()
        {
            return $this->raca;
        }   
        public function getPunts()
        {
            return $this->punts;
        }   
    }
?>