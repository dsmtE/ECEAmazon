<?php 
include "header.php"; 


if(!$admin) {
  $products = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idVendeur = '.Session::getSession()->read('user')->idUser);
}else { //sinon on recupere tout en tnt qu'admin
  $products = Site::getDatabase()->requete('SELECT * FROM Produits');
}

?>

<div class="row m-4"> 

  <div class="col-sm-8 offset-sm-2 rounded">
    <h1 class="text-left mt-2 mb-4">Produits mis à la vente</h1>
    <div class="px-4" style=" overflow-y: scroll; max-height: 450px;" >
    

      <?php foreach ($products as $produit) {//pour chaques produits

        $vendeurInfos = Site::getDatabase()->requete('SELECT * FROM Utilisateurs WHERE idUser = '.$produit->idVendeur)->fetch();

        ?>
        <div class="row mb-3" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
          <div class="col-sm-4 mt-3">
            <?php echo '<img style="max-width: 100px; max-height: 100px;" src="data:image/jpeg;base64,'.base64_encode( $produit->img ).'"/>'; ?>
            <p class="text-left"> Quantité dispo : <?php echo $produit->quantity; ?> </p>
            <p class="text-left"> Vendu par : <?php echo $vendeurInfos->nom.' '.$vendeurInfos->prenom; ?> </p>

          </div>
          <div class="col-sm-8 mt-3">
            <p class='font-weight-bold'> <?php echo $produit->nom; ?> </p>
            <div class="dropdown-divider"></div>
            <p id="description" rows="3"> <?php echo $produit->description; ?> </p>
            <p class="text-right" id="prix">Prix <?php echo $produit->prix; ?>€</p>
            <a <?php echo 'href="modificationProduit.php?id='.$produit->idProduit.'"'; ?> class="btn btn-primary float-right mb-3 ">Modifier</a>
          </div>
        </div>
      <?php } ?>



      
      
    </div>
  </div>

</div>


<?php 
include "footer.php" ?>
