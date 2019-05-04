<?php

//sources: https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
include "header.php";
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


            <?php foreach (Session::getSession()->getPanierElems() as $produit) {
            $produitInfos = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = '.$produit['idProduit'])->fetch();
            $vendeurInfos = Site::getDatabase()->requete('SELECT * FROM Utilisateurs WHERE idVendeur = '.$produitInfos->idVendeur)->fetch();


            ?>
            <div class="row mb-3" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
              <div class="col-sm-4 mt-3">
                <img src="..." alt="..." class="img-thumbnail">
                <p class="text-left"> Quantité : <?php echo $produit['quantity']; ?> </p>
                <p class="text-left" id="idVendeur"> <?php echo $vendeurInfos->nom.' '.$vendeurInfos->prenom; ?> </p>

              </div>
              <div class="col-sm-8 mt-3">
                <p class="text-left" id="nomproduit"> </p>
                <textarea class="form-control" id="description" rows="3"> Prix <?php echo $produitInfos->description; ?> </textarea>
                <p class="text-right" id="prix">Prix <?php echo $produitInfos->prix; ?> </p>
                <button type="submit" class="btn btn-primary float-right mb-3">Supprimer</button>
              </div>
            </div>
          <?php } ?>

            
          </div>

          <div class="col-sm-12 mt-3">
            <div class="dropdown-divider"></div>
            <p class="text-left" >TOTAL</p>
            <button type="submit" class="btn btn-primary float-right mb-3">Passer la commande</button>
          </div>


        </div>
      </div>
    </div>

  </form>

<?php include "footer.php"; ?>

