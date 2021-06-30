<?php echo form_open(); ?>
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

<button type="submit" class="btn btn-dark">Ajouter</button>    
</form>