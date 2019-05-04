<?php

//sources: https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
include "header.php";

if(!empty($_GET) && isset($_GET['id']) && isset($_GET['variationQuantity'])) {

  Session::getSession()->panierChangeQuantity(Site::getDatabase(), $_GET['id'], $_GET['variationQuantity']);
  Session::getSession()->addMessage('info', 'le panier à été mit à jour');
  Site::redirection('panier.php');
}

?>

  <form style="padding: 40px;">
    <div class="row"> 

      <div class="col-sm-4">

        <h1 class="text-left mb-5">Mon panier</h1>

      </div>

      <div class="col-sm-8">

        <div class="row">

          <h1 class="text-left mt-2 mb-5">Mes Produits</h1>
          <div style=" overflow-y: scroll; " class="col-sm-12 rounded px-5">
    
            

            <?php 
            foreach (Session::getSession()->getPanierElems() as $produit) {

            $produitInfos = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [ $produit['idProduit'] ])->fetch();

            $vendeurInfos = Site::getDatabase()->requete('SELECT * FROM Utilisateurs WHERE idUser = '.$produitInfos->idVendeur)->fetch();

            ?>
            <div class="row mb-3" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
              <div class="col-sm-4 mt-3">
                <?php echo '<img style="max-width: 100px; max-height: 100px;" src="data:image/jpeg;base64,'.base64_encode( $produitInfos->img ).'"/>'; ?>
                <p class="text-left"> Quantité à acheter : <?php echo $produit['quantity']; ?> </p>
                <p class="text-left"> Vendu part :<?php echo $vendeurInfos->nom.' '.$vendeurInfos->prenom; ?> </p>
                <p class="text-left"> options selectionné : <?php echo $produit['option']; ?> </p>

              </div>
              <div class="col-sm-8 mt-1">
                <p class='font-weight-bold'> <?php echo $produitInfos->nom; ?> </p>
                <div class="dropdown-divider"></div>
                <p> <?php echo $produitInfos->description; ?> </p>
                <p class="text-right" id="prix">Prix <?php echo $produitInfos->prix; ?>€</p>

              <div class="ml-auto">
                    <a href="panier.php?id=<?php echo $produitInfos->idProduit; ?>&variationQuantity=1" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i></a>
                    <a href="panier.php?id=<?php echo $produitInfos->idProduit; ?>&variationQuantity=-1" class="btn btn-outline-secondary"><i class="fas fa-minus-circle"></i></a>
              </div>

                <!-- <a class="btn btn-primary float-right mb-3">supprimer</a> -->
              </div>
            </div>
          <?php 
          } 
          ?>
            
          </div>

          <div class="col-sm-12 mt-3">
            <div class="dropdown-divider"></div>
            <p class="text-left" >TOTAL : <?php echo Session::getSession()->panierTotal(Site::getDatabase());?>€</p>
            <a href="commande.php" class="btn btn-primary float-right mb-3">Passer la commande</a>
          </div>

        </div>
      </div>
    </div>

  </form>

<?php include "footer.php"; ?>

