 
<?php echo form_open_multipart('Produits/ajouter'); ?>

<h2>Veuillez remplir ces champs pour ajouter le produit</h2>

<form action="" method="POST">
<div class="form-group">
   <label for="pro_cat_id">cat</label>
   <input type="number" name="pro_cat_id" id="pro_cat_id" value="<?php echo set_value('pro_cat_id'); ?>" class="form-control">
</div> 

<div class="form-group">
   <label for="pro_libelle">Libellé</label>
   <input type="text" name="pro_libelle" id="pro_libelle" class="form-control">
   <?php echo form_error('pro_libelle'); ?>
</div> 

<div class="form-group">
   <label for="pro_ref">Référence</label>
   <input type="text" name="pro_ref" id="pro_ref" class="form-control">
   
</div> 

<div class="form-group">
    <label for="pro_description">Description</label>
    <textarea class="form-control" id="pro_description" name="pro_description" rows="3"></textarea>
  </div>

<div class="form-group">
   <label for="pro_photo">Photo</label>
   <input type='file' size='20' name='pro_photo' id='pro_photo' class='form-control'>
</div> 


<button type="submit" class="btn btn-dark">Ajouter</button>    
</form>