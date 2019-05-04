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

  //list des choix selectionée
  $subReq1 = 'SELECT CC.idChoix, CC.nom FROM CaraChoix AS CC JOIN Carateristiques AS C ON CC.idCara = C.idCara WHERE';

  foreach ($choixSelected as $key => $c) {
    $subReq1 .= ' CC.nom = "'.$key.'" OR';
  }
  $subReq1 = substr("$subReq1", 0, -2);

  $subReq2 = 'SELECT CDP.idProduit FROM ChoixDispoProduits as CDP JOIN ('.$subReq1.') AS CC ON CC.idChoix = CDP.idChoix ';

  $reqMaster = 'SELECT * FROM Produits AS P JOIN ('.$subReq2.') as CDP ON P.idProduit = CDP.idProduit';


  echo "<pre>";
  print($subReq1);
  print_r(Site::getDatabase()->requete($subReq1)->fetchAll());
  echo "</pre>";
  echo "\n";

  echo "<pre>";
  print($subReq2);
  print_r(Site::getDatabase()->requete($subReq2)->fetchAll());
  echo "</pre>";

  // echo "<pre>";
  // print_r(Site::getDatabase()->requete($reqMaster)->fetchAll());
  // echo "</pre>";

  $products = Site::getDatabase()->requete($reqMaster)->fetchAll();

}else { //sinon on recupere tout
  $products = Site::getDatabase()->requete('SELECT * FROM Produits')->fetchAll();
}

// echo "<pre>";
// print_r($products->fetchAll());
// echo "</pre>";


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
    

      <?php foreach ($products as $produit) {//pour chaques produits

        $vendeurInfos = Site::getDatabase()->requete('SELECT * FROM Utilisateurs WHERE idUser = '.$produit->idVendeur)->fetch();

        ?>
        <div class="row mb-3" style="border-style: solid; border-width: 0.1em; border-color: #ddd;">
          <div class="col-sm-4 mt-3">
            <?php echo '<img style="width: 50px; height: 50px;" src="data:image/jpeg;base64,'.base64_encode( $produit->img ).'"/>'; ?>
            <p class="text-left"> Quantité dispo : <?php echo $produit->quantity; ?> </p>
            <p class="text-left" id="idVendeur"> Vendu par : <?php echo $vendeurInfos->nom.' '.$vendeurInfos->prenom; ?> </p>

          </div>
          <div class="col-sm-8 mt-3">
            <p class="text-left" id="nomproduit"> </p>
            <p class="form-control" id="description" rows="3"> Prix <?php echo $produit->description; ?> </p>
            <p class="text-right" id="prix">Prix <?php echo $produit->prix; ?> </p>
            <button type="submit" class="btn btn-primary float-right mb-3">Supprimer</button>
          </div>
        </div>
      <?php } ?>
  
    </div>
  </div>

</div>


<?php include "footer.php" ?>
