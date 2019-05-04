<?php 
  include "header.php"; 
  
  if(isset($_GET['admin']) && $_GET['admin'] == 1 && $admin) {

    

  } 


?>



<form style="padding: 40px;">
    <div class="row"> 

        <div class="col-sm-4">

            <h1 class="text-left mb-5">Préférences</h1>

            <div class="row"> 
                <div class="col-sm-6">

       <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01"> Taille </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01">
    <option selected>Choisir...</option>
    <option value="1">S</option>
    <option value="2">M</option>
    <option value="3">L</option>
    <option value="4">All</option>
  </select>
</div>
</div>

<div class="col-sm-6">
    
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01"> Couleur </label>
  </div>
  <select class="custom-select" id="inputGroupSelect01">
    <option selected>Choisir...</option>
    <option value="1">Rouge</option>
    <option value="2">Vert</option>
    <option value="3">Bleu</option>
    <option value="4">Jaune</option>
  </select>
</div>
</div>

</div>
</div>


        <div style=" overflow-y: scroll; " class="col-sm-8 rounded px-5">

        <h1 class="text-left mt-2 mb-5">Produits disponibles</h1>

        <div class="row" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
            <div class="col-sm-4">
                <img src="..." alt="..." class="img-thumbnail">
                <p class="text-left"> Quantité : </p>
                <p class="text-left"> Vendu par </p>

            </div>
            <div class="col-sm-8">
                <p class="text-left" id="nomproduit">Nom du produit</p>
                <textarea class="form-control" id="description" rows="3"></textarea>
                <p class="text-right" id="prix">Prix</p>
                <button type="submit" class="btn btn-primary float-right mb-3">Panier</button> <!-- modification if admin -->
            </div>
        </div>

    </div>
</div>



</form>

<?php include "footer.php" ?>
