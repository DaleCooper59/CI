<?php

defined('BASEPATH') OR exit ('No direct script access allowed');

class ListeProduit extends CI_Model {
    public function getProducts(){
        return  $aProduits = ["Aramis", "Athos", "Clatronic", "Camping", "Green"];
    }
}