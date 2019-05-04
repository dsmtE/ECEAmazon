<?php 
include "header.php"; 


if(!$admin) {
  $products = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idVendeur = '.$user->idUser);
}else { //sinon on recupere tout en tnt qu'admin
  $products = Site::getDatabase()->requete('SELECT * FROM Produits');
}

?>

<div class="row m-4"> 

  <div class="col-sm-4">

    <h1 class="text-left mb-4">Préférences</h1>

    <form class="p-2 w-75" action="" method="POST" enctype="multipart/form-data">
      <div class="row">
        <?php foreach (Site::getDatabase()->requete("SELECT * FROM Carateristiques") as $cara) { ?>
          <div class="input-group col-sm-6 mb-4" id="caraChoix_<?php echo $cara->nom; ?>">
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $cara->nom;?></button>
              <div class="dropdown-menu">
                <?php   
                foreach (Site::getDatabase()->requete("SELECT choix.nom FROM CaraChoix as choix JOIN Carateristiques AS cara ON choix.idCara = cara.idCara  WHERE  cara.idCara = ?", [$cara->idCara]) as $choix) {
                  echo '<a class="dropdown-item"><input type="checkbox" name="'.$cara->nom.'_'.$choix->nom.'" value="'.$choix->nom.'">'.$choix->nom.'</a>';
                }
                ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>

      <button type="submit" class="btn btn-primary ">Valider les préférences</button>
    </form>
  </div>


  <div class="col-sm-8 rounded">
    <h1 class="text-left mt-2 mb-4">Produits disponibles</h1>
    <div class="px-4" style=" overflow-y: scroll; max-height: 450px;" >

      <div class="row mb-2" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
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

      <div class="row mb-2" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
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

      <div class="row mb-2" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
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

</div>


<?php include "footer.php" ?>
