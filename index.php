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
        
        <div class="row justify-content-center"> <!--sous bloc produits-->
            

            <div class="col-sm-3"> <!--sous bloc produit 1-->
                <div class="row justify-content-center"><!--catégorie produit 1-->
                    <div class="col-sm-7">
                        <h3 class="text-center" style="font-style : italic; float: left; text-shadow: 1px 1px #000000;">Littérature</h3>
                    </div>
                </div>
                <div class="row justify-content-center"> <!-- Photo produit 1-->
                    <div class="col-sm-7">
                        <i class="far fa-image fa-10x" id="photo1"><!--placeholder SQL--></i>
                    </div>
                </div>
                <div class="row justify-content-center"><!--Nom du produit-->
                    <div class= "col-sm-7" id="NomProduit" style="float:left; font-size : 18px; padding-bottom: 10px;">NomProduit <!--placeholder SQL--></div>
                </div>
                <div class="row justify-content-center"><!-- Description du produit-->
                    <div class="col-sm-7" id="Description" style="background-color :#C4C1C0;border-radius: 10px; text-align : left;">
                        description***********
                        **********************
                        **********************
                        <!--placeholder SQL-->
                        <p id="nomVendeur" style="font-style : italic; text-align: center;">NomVendeur  <!--placeholder SQL--></p>
                        <p style="font-style : bold; text-align: center; display : inline-block; padding-left : 3em;">Prix : <p id="prix" style="display : inline-block; font-style : bold; text-align: center; padding-left: 0.5em;"> -- <!--placeholder SQL--> </p> €</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-5 align-self-center"><input type="button" name="productFeatures" value="Voir le produit" style="background-color: #1EE91E; margin-top: 1em;">
                    </div>
                </div>
            </div>

            <div class="col-sm-3"> <!--sous bloc produit 2-->
                <div class="row justify-content-center"><!--catégorie produit 2-->
                    <div class="col-sm-7">
                        <h3 class="text-center" style="font-style : italic; float: left; text-shadow: 1px 1px #000000;">Musique</h3>
                    </div>
                </div>
                <div class="row justify-content-center"> <!-- Photo produit 2-->
                    <div class="col-sm-7">
                        <i class="far fa-image fa-10x" id="photo2"><!--placeholder SQL--></i>
                    </div>
                </div>
                <div class="row justify-content-center"><!--Nom du produit-->
                    <div class= "col-sm-7" id="NomProduit" style="float:left; font-size : 18px; padding-bottom: 10px;">NomProduit <!--placeholder SQL--></div>
                </div>
                <div class="row justify-content-center"><!-- Description du produit-->
                    <div class="col-sm-7" id="Description" style="background-color :#C4C1C0;border-radius: 10px; text-align : left;">
                        description***********
                        **********************
                        **********************
                        <!--placeholder SQL-->
                        <p id="nomVendeur" style="font-style : italic; text-align: center;">NomVendeur  <!--placeholder SQL--></p>
                        <p style="font-style : bold; text-align: center; display : inline-block; padding-left : 3em;">Prix : <p id="prix" style="display : inline-block; font-style : bold; text-align: center; padding-left: 0.5em;"> -- <!--placeholder SQL--> </p> €</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-5 align-self-center"><input type="button" name="productFeatures" value="Voir le produit" style="background-color: #1EE91E; margin-top: 1em;">
                    </div>
                </div>
            </div>

            <div class="col-sm-3"> <!--sous bloc produit 3-->
                <div class="row justify-content-center"><!--catégorie produit 3-->
                    <div class="col-sm-7">
                        <h3 class="text-center" style="font-style : italic; float: left; text-shadow: 1px 1px #000000;">Mode</h3>
                    </div>
                </div>
                <div class="row justify-content-center"> <!-- Photo produit 3-->
                    <div class="col-sm-7">
                        <i class="far fa-image fa-10x" id="photo3"><!--placeholder SQL--></i>
                    </div>
                </div>
                <div class="row justify-content-center"><!--Nom du produit-->
                    <div class= "col-sm-7" id="NomProduit" style="float:left; font-size : 18px; padding-bottom: 10px;">NomProduit <!--placeholder SQL--></div>
                </div>
                <div class="row justify-content-center"><!-- Description du produit-->
                    <div class="col-sm-7" id="Description" style="background-color :#C4C1C0;border-radius: 10px; text-align : left;">
                        description***********
                        **********************
                        **********************
                        <!--placeholder SQL-->
                        <p id="nomVendeur" style="font-style : italic; text-align: center;">NomVendeur  <!--placeholder SQL--></p>
                        <p style="font-style : bold; text-align: center; display : inline-block; padding-left : 3em;">Prix : <p id="prix" style="display : inline-block; font-style : bold; text-align: center; padding-left: 0.5em;"> -- <!--placeholder SQL--> </p> €</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-5 align-self-center"><input type="button" name="productFeatures" value="Voir le produit" style="background-color: #1EE91E; margin-top: 1em;">
                    </div>
                </div>
            </div>

            <div class="col-sm-3"> <!--sous bloc produit 4-->
                <div class="row justify-content-center"><!--catégorie produit 4-->
                    <div class="col-sm-8">
                        <h3 class="text-center" style="font-style : italic; float: left; text-shadow: 1px 1px #000000;">Sport et loisirs</h3>
                    </div>
                </div>
                <div class="row justify-content-center"> <!-- Photo produit 4-->
                    <div class="col-sm-7">
                        <i class="far fa-image fa-10x" id="photo2"><!--placeholder SQL--></i>
                    </div>
                </div>
                <div class="row justify-content-center"><!--Nom du produit-->
                    <div class= "col-sm-7" id="NomProduit" style="float:left; font-size : 18px; padding-bottom: 10px;">NomProduit <!--placeholder SQL--></div>
                </div>
                <div class="row justify-content-center"><!-- Description du produit-->
                    <div class="col-sm-7" id="Description" style="background-color :#C4C1C0;border-radius: 10px; text-align : left;">
                        description***********
                        **********************
                        **********************
                        <!--placeholder SQL-->
                        <p id="nomVendeur" style="font-style : italic; text-align: center;">NomVendeur  <!--placeholder SQL--></p>
                        <p style="font-style : bold; text-align: center; display : inline-block; padding-left : 3em;">Prix : <p id="prix" style="display : inline-block; font-style : bold; text-align: center; padding-left: 0.5em;"> -- <!--placeholder SQL--> </p> €</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-5 align-self-center"><input type="button" name="productFeatures" value="Voir le produit" style="background-color: #1EE91E; margin-top: 1em;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "footer.php";
?>
