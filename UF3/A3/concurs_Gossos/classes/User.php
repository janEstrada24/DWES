<?php
    class User {
        //PROPIETATS
        //private: només permet accedir-hi des de la pròpia classe
        private $nom;
        private $contrasenya;

        //CONSTRUCTOR: s'executa quan es crea l'objecte
        public function __construct($nom, $contrasenya) {
            $this->nom = $nom;
            $this->contrasenya = $contrasenya;
        }

        //MÈTODES
        public function getNom()
        {
            return $this->nom;
        }

        public function getContrasenya()
        {
            return $this->contrasenya;
        }
    }    
?>