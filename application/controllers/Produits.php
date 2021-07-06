<?php
defined('BASEPATH') OR exit('No direct script access allowed');      

class Produits extends CI_Controller 
{
    function __construct()
	{
	parent::__construct();
	
	}
	
    public function liste()
    //READ
    {

    // Exécute la requête 
    $results = $this->db->query("SELECT * FROM produits");  

    // Récupération des résultats    
    $aListe = $results->result();   
  
    // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue = récupérée sur la vue avec $  
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
  $this->load->view('ajouter');
  $this->load->helper('form');
  $this->load->library('form_validation');
	
if ($this->input->post()) 
    { 
     $datas = $this->input->post(); 

      // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
      $this->form_validation->set_rules("pro_ref", "Référence", "required|min_length[5]", array("required" => "Le %s doit être obligatoire."));
      $this->form_validation->set_rules("pro_description", "Description", "required|min_length[10]", array("required" => "Le %s doit être obligatoire."));
 
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            // On extrait l'extension du nom du fichier 
           // Dans $_FILES["pro_photo"], pro_photo est la valeur donnée à l'attribut name du champ de type 'file'  
           $extension = substr(strrchr($_FILES["pro_photo"]["name"], "."), 1); 
          
           $config['upload_path'] = './assets/img_upload/';
           $config['file_name'] = $_FILES["pro_photo"]["name"]; 
           
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        //$this->load->library('upload', $config);
        $datas['pro_photo'] = $extension;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('pro_photo')) 
		{
            $errorUpload = $this->upload->display_errors("<div class='alert alert-danger'>", "</div>");

            $aView["errorUpload"] = $errorUpload;

            error_log($errorUpload, 0);

            $this->load->library('session'); 
            $this->session->set_flashdata('sUploadError2','Le téléchargement de la photo a échoué.');

            $this->load->view('ajouter', $aView);
        } 
		else 
		{
            $data = array('image_metadata' => $this->upload->data());

            $this->load->view('imageupload_success', $data);
        }
     
    
    $this->db->insert('produits', $datas);

    redirect("produits/liste");
       
        
    }else 
    { // 1er appel de la page: affichage du formulaire
        $this->load->view('ajouter');
    }
} // -- ajouter()


public function modifier($id)
//UPDATE
{
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
   
    $this->db->where('pro_id', $id);

    $this->db->delete('produits');

    redirect("produits/liste");
}

}