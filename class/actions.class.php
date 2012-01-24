<?php

class Actions {
    
    private $id;
    private $idMembre;
    private $actions;
    private $timestamp;
    
    function __construct($id,$idMembre,$actions,$timestamp) {
        $this->id = $id;
        $this->idMembre = $idMembre;
        $this->actions = $actions;
        $this->timestamp = $timestamp;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getIdMembre() {
        return $this->idMembre;
    }

    public function getActions() {
        return $this->actions;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdMembre($idMembre) {
        $this->idMembre = $idMembre;
    }

    public function setActions($actions) {
        $this->actions = $actions;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    function intervalleTime() {
        $date = strtotime($this->timestamp);
        $now = time();
        $result = $now - $date;
        if($result < 60) {
            return $result.' secondes';
        }
        elseif($result > 60 && $result < 3600) {
            $min = round($result / 60,0);
            return $min.' minutes';
        }
        elseif($result > 3600 && $result < 86400) {
            $heure = round($result / (60*60),0);
            return $heure.' heures';
        }
        elseif($result > 86400 && $result < 2678400) {
            $jours = round($result / (60*60*24));
            return $jours.' jours';
        }
        elseif($result > 2678400) {
            $mois = round($result / (60*60*24*31));
            return $mois.' mois';
        }
    }

}
?>
