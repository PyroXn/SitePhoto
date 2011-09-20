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


}
?>
