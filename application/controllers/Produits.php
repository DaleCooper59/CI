<?php
defined('BASEPATH') OR exit('No direct script access allowed');      

class Produits extends CI_Controller 
{
    
    public function liste()
    //READ
    {

        // Charge la librairie 'database'
    $this->load->database();

    // Exécute la requête 
    $results = $this->db->query("SELECT * FROM produits");  

    // Récupération des résultats    
    $aListe = $results->result();   

    // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue   
    $aView["liste_produits"] = $aListe;

    // Appel de la vue avec transmission du
        
        /*$this->load->model('listeProduit');
        $produits['data'] = $this->listeProduit->getProducts();*/
        $this->load->view('headers');

        $this->load->view('liste', $aView);

        $this->load->view('footers');
    }

    public function ajouter()
    //ADD
{
    // Chargement des assistants 'form' et 'url'
    $this->load->helper('form', 'url'); 

    // Chargement de la vue 'ajouter.php'
    $this->load->database();

     // Chargement de la librairie form_validation
     $this->load->library('form_validation');

      // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
      $this->form_validation->set_rules("pro_ref", "Référence", "required|min_length[5]", array("required" => "Le %s doit être obligatoire."));

      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    
    if ($this->input->post()) 
    { // 2ème appel de la page: traitement du formulaire

         $data = $this->input->post();

         $this->db->insert('produits', $data);

         redirect("produits/liste");
    } 
    else 
    { // 1er appel de la page: affichage du formulaire
        $this->load->view('ajouter');
    }
} // -- ajouter()


public function modifier($id)
//UPDATE
{
     // Chargement des assistants 'form' et 'url'
     //$this->load->helper('form', 'url'); 

     // Chargement de la librairie 'database'
     $this->load->database();  
 
     // Chargement de la librairie form_validation
     $this->load->library('form_validation'); 
 
     // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
     $produit = $this->db->query("SELECT * FROM produits WHERE pro_id=" . $id);
     $aView["produit"] = $produit->row(); // première ligne du résultat
 
     if ($this->input->post()) 
     { // 2ème appel de la page: traitement du formulaire
 
        $data = $this->input->post();
 
        // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
        $this->form_validation->set_rules('pro_ref', 'Référence', 'required');
 
        if ($this->form_validation->run() == FALSE)
        { // Echec de la validation, on réaffiche la vue formulaire 
            $this->load->view('modifier', $aView);
        }
        else
        { // La validation a réussi, nos valeurs sont bonnes, on peut modifier en base  
 
           /* Utilisation de la méthode where() toujours 
           * avant select(), insert() ou update()
           * dans cette configuration sur plusieurs lignes 
           */  
           $this->db->where('pro_id', $id);
           $this->db->update('produits', $data);
 
           redirect("produits/liste");
       }
     } 
     else 
     { // 1er appel de la page: affichage du formulaire             
        $this->load->view('modifier', $aView);
     }

} // -- modifier()

public function effacer($id)
//DELETE
{
    $this->load->database();

    $this->db->where('pro_id', $id);

    $this->db->delete('produits');

    redirect("produits/liste");
}

}