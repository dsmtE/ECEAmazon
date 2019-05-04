<?php 
include "header.php"; 

if(!empty($_POST)) { // si on recoi des données pour le filtrage

  $caraSelected = array();
  $choixSelected = array();

  foreach( $_POST as $key => $postValue) {
    $caraSelected[explode('_', $key)[0]] = 1;
    $choixSelected[explode('_', $key)[1]] = 1;
  }


//'SELECT * FROM Produits AS P JOIN ChoixDispoProduit as CDP ON P.idProduit = CDP.idProduit';
// 'SELECT CDP.idProduit FROM ChoixDispoProduit as CDP JOIN CaraChoix AS CC ON CC.idChoix = CDP.idChoix WHERE CC.nom == $selected  && ..';
// 'SELECT * FROM CaraChoix AS CC JOIN Carateristiques AS C ON CC.idCara = C.idCara WHERE C.nom = $caraSelected';


  $subReq1 = 'SELECT CC.idChoix, C.nom FROM CaraChoix AS CC JOIN Carateristiques AS C ON CC.idCara = C.idCara WHERE';

  foreach ($caraSelected as $key => $c) {
    $subReq1 .= ' C.nom = "'.$key.'" OR';
  }
  $subReq1 = substr("$subReq1", 0, -2);

  $subReq2 = 'SELECT CDP.idProduit, CC.nom FROM ChoixDispoProduits as CDP JOIN ('.$subReq1.') AS CC ON CC.idChoix = CDP.idChoix WHERE';

  foreach ($choixSelected as $key => $c) {
    $subReq2 .= ' CC.nom = "'.$key.'" OR';
  }
  $subReq2 = substr("$subReq2", 0, -2);

  $reqMaster = 'SELECT * FROM Produits AS P JOIN ('.$subReq2.') as CDP ON P.idProduit = CDP.idProduit';

  // echo "<pre>";
  // print_r($subReq1);
  // echo "</pre>";

  // echo "<pre>";
  // print_r($subReq2);
  // echo "</pre>";

  // echo "<pre>";
  // print_r($reqMaster);
  // echo "</pre>";

  $products = Site::getDatabase()->requete($reqMaster);

}else { //sinon on recupere tout
  $products = Site::getDatabase()->requete('SELECT * FROM Produits');
}


//'SELECT * FROM Produits AS P JOIN ChoixDispoProduit as CDP ON P.idProduit = CDP.idProduit';
// 'SELECT CDP.idProduit FROM ChoixDispoProduit as CDP JOIN CaraChoix AS CC ON CC.idChoix = CDP.idChoix WHERE CC.nom == $selected  && ..';
// 'SELECT * FROM CaraChoix AS CC JOIN Carateristiques AS C ON CC.idCara = C.idCara WHERE C.nom = $caraSelected';

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
