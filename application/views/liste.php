<!-- application/views/liste.php -->


    <h1>Identité</h1>
    

    <h2>Liste des produits</h2>
     <a href="<?php echo site_url('Produits/ajouter')?>" class="btn btn-danger">Ajouter</a>
          

<br><br>

    <table class="table table-primary">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Reférence</th>
      <th scope="col">Libellé</th>
      <th scope="col">Description</th>
      <th scope="col">Photo</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($liste_produits as $row):?>
    <tr>
      <th scope="row"><?php echo $row->pro_id ?></th>
      <td><?php echo $row->pro_ref ?></td>
      <td><?php echo $row->pro_libelle ?></td>
      <td><?php echo $row->pro_description ?></td>
      <td><?php echo $row->pro_photo ?></td>
      <td><a href="<?php echo site_url('Produits/modifier/' . $row->pro_id )?>">modifier</a> | <a href="<?php echo site_url('Produits/effacer/' . $row->pro_id )?>" onclick="return(confirm('Vous êtes sûr?'));">effacer</a></td>
    </tr>
    <?php endforeach;?>

  </tbody>
</table>
    <h3>test</h3>
    <?php echo site_url();?>
    <br>
    <?php echo base_url();?>

    