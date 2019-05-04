<?php
include "header.php";
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
    <img class="card-img-top" src="..." alt="Card image cap" id="imgProduit1">
    <div class="card-body">
      <h5 class="card-title" id="produit1Name">Produit 1</h5>
      <p class="card-text" id="produit1Description">Description produit 1</p>
      <p class="card-text" id="produit1Vendeur" style="font-style: italic; text-align: center;">NomVendeur</p>
    </div>
    <div class="card-footer">
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price1" style="display: inline-block; text-align: center;">--,--</p> €</small>
    </div>
  </div>
  <div class="card" id="produit2"><!-- sous produit 2-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Musique</h1>
    </div>
    <img class="card-img-top" src="..." alt="Card image cap" id="imgProduit2">
    <div class="card-body">
      <h5 class="card-title" id="produit2Name">Produit 2</h5>
      <p class="card-text" id="produit2Description">Description produit 2</p>
      <p class="card-text" id="produit2Vendeur" style="font-style: italic; text-align: center;">NomVendeur</p>
    </div>
    <div class="card-footer">
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price1" style="display: inline-block; text-align: center;">--,--</p> €</small>
    </div>
  </div>
  
  <div class="card" id="produit3"><!-- sous produit 3-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Mode</h1>
    </div>
    <img class="card-img-top" src="..." alt="Card image cap" id="imgProduit3">
    <div class="card-body">
      <h5 class="card-title" id="produit3Name">Produit 3</h5>
      <p class="card-text" id="produit3Description">Description produit 1</p>
      <p class="card-text" id="produit3Vendeur" style="font-style: italic; text-align: center;">NomVendeur</p>
    </div>
    <div class="card-footer">
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price1" style="display: inline-block; text-align: center;">--,--</p> €</small>
    </div>
  </div>
  <div class="card" id="produit4"><!-- sous produit 4-->
    <div class="card-header" >
        <h3 style="font-style: italic; text-shadow: 2px 1px #3D3C3C;color: rgb(23,162,184,0.6)">Sports et loisirs</h1>
    </div>
    <img class="card-img-top" src="..." alt="Card image cap" id="imgProduit1">
    <div class="card-body">
      <h5 class="card-title" id="produit4Name">Produit 4</h5>
      <p class="card-text" id="produit4Description">Description produit 4</p>
      <p class="card-text" id="produit4Vendeur" style="font-style: italic; text-align: center;">NomVendeur</p>
    </div>
    <div class="card-footer">
      <small class="text-muted" style="font-size: 1em;">Prix : <p class="text-muted" id="price1" style="display: inline-block; text-align: center;">--,--</p> €</small>
    </div>
  </div>
</div>

    </div>
</div>


<?php
include "footer.php";
?>
