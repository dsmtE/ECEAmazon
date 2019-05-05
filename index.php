<?php
include "header.php";

$produit1ID = Site::getDatabase()->requete('SELECT Achats.idProduit FROM Achats JOIN Produits ON Achats.idProduit = Produits.idProduit WHERE Produits.categorie = "livres" GROUP BY Achats.idProduit ORDER BY(Achats.quantity) DESC LIMIT 1')->fetch();

$produit2ID = Site::getDatabase()->requete('SELECT Achats.idProduit FROM Achats JOIN Produits ON Achats.idProduit = Produits.idProduit WHERE Produits.categorie = "musique" GROUP BY Achats.idProduit ORDER BY(Achats.quantity) DESC LIMIT 1')->fetch();

$produit3ID = Site::getDatabase()->requete('SELECT Achats.idProduit FROM Achats JOIN Produits ON Achats.idProduit = Produits.idProduit WHERE Produits.categorie = "vetements" GROUP BY Achats.idProduit ORDER BY(Achats.quantity) DESC LIMIT 1')->fetch();

$produit4ID = Site::getDatabase()->requete('SELECT Achats.idProduit FROM Achats JOIN Produits ON Achats.idProduit = Produits.idProduit WHERE Produits.categorie = "sport" GROUP BY Achats.idProduit ORDER BY(Achats.quantity) DESC LIMIT 1')->fetch();


$pdt1 = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [$produit1ID->idProduit])->fetch();
$pdt2 = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [$produit2ID->idProduit])->fetch();
$pdt3 = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [$produit3ID->idProduit])->fetch();
$pdt4 = Site::getDatabase()->requete('SELECT * FROM Produits WHERE idProduit = ?', [$produit4ID->idProduit])->fetch();


$vendeur1 = Site::getDatabase()->requete('SELECT Utilisateurs.nom,Utilisateurs.prenom FROM Utilisateurs WHERE idUser = ?',[$pdt1->idVendeur])->fetch();
$vendeur2 = Site::getDatabase()->requete('SELECT Utilisateurs.nom,Utilisateurs.prenom FROM Utilisateurs WHERE idUser = ?',[$pdt2->idVendeur])->fetch();
$vendeur3 = Site::getDatabase()->requete('SELECT Utilisateurs.nom,Utilisateurs.prenom FROM Utilisateurs WHERE idUser = ?',[$pdt3->idVendeur])->fetch();
$vendeur4 = Site::getDatabase()->requete('SELECT Utilisateurs.nom,Utilisateurs.prenom FROM Utilisateurs WHERE idUser = ?',[$pdt4->idVendeur])->fetch();


?>

<div class="row justify-content-center" style="margin : 1em;"> <!--Bloc global-->
    <div class=" col-sm-5  align-self-center ">
        <div class="row"><!-- Sous bloc logo/titre-->
            <div class="col-sm-4"><!-- Sous colonne logo-->
                <i alt="LogoECEAmazon" class="fab fa-artstation fa-7x mt-2" style="float:right;"></i>
            </div>
            <div class="col-sm-7" style="top: 1em;"><!-- Sous colonne titre/sous-titres-->
                <div class="row"><!--sous bloc titre-->
                    <div class="col">
                        <h1 class="text-center" style="font-size:3em; font-style : bold;color: rgb(23,162,184); ">ECEAmazon</h1>
                    </div>
                </div>
                <div class="row"><!-- Sous bloc sous titre-->
                    <div class="col">
                        <h2 class="text-center" style="font-size : 1.6em; font-style: italic;color: rgb(23,162,184,0.6);">N°1 de la vente en ligne</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row justify-content-center" style="margin: 1em;"><!--bloc global-->
    <div class="col align-self-center">

        <div class="row"> <!-- sous bloc titre-->
            <div class="col">
                <h2 class="text-center" style="padding: 2em; font-style: italic; text-shadow: 2px 1px #3D3C3C;"> Best-sellers du moment</h2>
            </div>
        </div>


<div class="card-deck">
  <div class="card" id="produit1"><!-- sous produit 1-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Littérature</h1>
    </div>
    <img class="card-img-top align-self-center mt-1" alt="Card image cap"<?php echo'src= "data:image/jpeg;base64,'.base64_encode($pdt1->img).'" ' ?>style="max-width: 100px; max-height: 100px;">
    <div class="card-body">
      <h5 class="card-title" id="produit1Name"><?php echo $pdt1->nom; ?></h5>
      <p class="card-text" id="produit1Description"><?php echo $pdt1->description;  ?></p> 
    </div>
    <div class="card-footer">
      <p class="card-text" id="produit1Vendeur" style="font-style: italic; text-align: center;">Vendu par : <?php echo $vendeur1->nom.' '.$vendeur1->prenom; ?></p>
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price1" style="display: inline-block; text-align: center;"><?php echo $pdt1->prix; ?></p> €</small>
    </div>
  </div>
  <div class="card" id="produit2" ><!-- sous produit 2-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Musique</h1>
    </div>
    <img class="card-img-top align-self-center mt-1"  alt="Card image cap" <?php echo'src= "data:image/jpeg;base64,'.base64_encode($pdt2->img).'" ' ?>style="max-width: 100px; max-height: 100px;">
    <div class="card-body">
      <h5 class="card-title" id="produit2Name"><?php echo $pdt2->nom; ?></h5>
      <p class="card-text" id="produit2Description"><?php echo $pdt2->description;  ?></p>
    </div>
    <div class="card-footer">
      <p class="card-text" id="produit2Vendeur" style="font-style: italic; text-align: center;">Vendu par : <?php echo $vendeur2->nom.' '.$vendeur2->prenom; ?></p>
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price2" style="display: inline-block; text-align: center;"><?php echo $pdt2->prix; ?></p> €</small>
    </div>
  </div>
  
  <div class="card" id="produit3"><!-- sous produit 3-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Mode</h1>
    </div>
    <img class="card-img-top align-self-center mt-1" alt="Card image cap" <?php echo'src= "data:image/jpeg;base64,'.base64_encode($pdt3->img).'" ' ?> style="max-width: 100px; max-height: 100px;">
    <div class="card-body">
      <h5 class="card-title" id="produit3Name"><?php echo $pdt3->nom; ?></h5>
      <p class="card-text" id="produit3Description"><?php echo $pdt3->description;  ?></p>
      
    </div>
    <div class="card-footer">
      <p class="card-text" id="produit3Vendeur" style="font-style: italic; text-align: center;">Vendu par : <?php echo $vendeur3->nom.' '.$vendeur3->prenom; ?></p>
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price3" style="display: inline-block; text-align: center;"><?php echo $pdt3->prix; ?></p> €</small>
    </div>
  </div>
  <div class="card" id="produit4"><!-- sous produit 4-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Sports et loisirs</h1>
    </div>
    <img class="card-img-top align-self-center mt-1" alt="Card image cap" <?php echo'src= "data:image/jpeg;base64,'.base64_encode($pdt4->img).'" ' ?> style="max-width: 100px; max-height: 100px;">
    <div class="card-body">
      <h5 class="card-title" id="produit4Name"><?php echo $pdt4->nom; ?></h5>
      <p class="card-text" id="produit4Description"><?php echo $pdt4->description;  ?></p>
    </div>
    <div class="card-footer">
       <p class="card-text" id="produit4Vendeur" style="font-style: italic; text-align: center;">Vendu par : <?php echo $vendeur4->nom.' '.$vendeur4->prenom; ?></p>
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price4" style="display: inline-block; text-align: center;"><?php echo $pdt4->prix; ?></p> €</small>
    </div>
  </div>
</div>

    </div>
</div>


<?php
include "footer.php";
?>
