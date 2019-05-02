<?php include "header.php" ?>

<div class="row">
	<div class="col bg-info" id="banniere"> <!--placeholder SQL-->
		<div class="row">
			<div class="col-2 text-white" id="NomPrenom" style="padding : 1.5em 0 1em 3em;">
				Nom Prénom <!--placeholder SQL-->
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1" id="iconUser" style="padding : 0 0 3em 5em"> <!--placeholder SQL-->
				<i class="far fa-user-circle fa-6x" style="color :white;"></i>
			</div>
		</div>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col-md-8 align-content-center">
		<form>
			<div class="form-group row">
				<label for="inputProductName" class="col-sm-4 col-form-label">Nom du produit :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputProductName" placeholder="Nom">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputCategorie" class="col-sm-4 col-form-label">Catégorie :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="inputCategorie" placeholder="Ex : Livres,Musique etc...">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputDescription" class="col-sm-4 col-form-label">Description :</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="inputDescription"></textarea>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-sm-4"></div>
</div>
<?php include "footer.php" ?>