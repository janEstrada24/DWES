<?php
    class Fase {
        //PROPIETATS
        //private: només permet accedir-hi des de la pròpia classe
        private $numFase;
        private $dataInici;
        private $dataFinal;

        //CONSTRUCTOR: s'executa quan es crea l'objecte
        public function __construct($numFase, $dataInici, $dataFinal) {
            $this->numFase = $numFase;
            $this->dataInici = $dataInici;
            $this->dataFinal = $dataFinal;
        }

        //MÈTODES
        public function getNumFase()
        {
            return $this->numFase;
        }
        public function getDataInici()
        {
            return $this->dataInici;
        }
        public function getDataFinal()
        {
            return $this->dataFinal;
        }  
    }    
?>