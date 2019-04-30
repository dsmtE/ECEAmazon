<?php 
  require_once 'phpClass/autoloader.php'; // chargement des différentes classes php 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- responsive meta tag also optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <meta name="description" content=""> -->
    <!-- <meta name="author" content=""> -->
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>ECEAmazon</title>

    <!-- Compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!--Import fontawesome Icon & Font-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="css/custom.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#"><i class="fab fa-artstation"></i></a>

      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="lien désactivé"> <!-- tooltip on disable link -->
            <a class="nav-link disabled" href="#">Disabled</a>
            </span>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdownAdmin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu" aria-labelledby="dropdownAdmin">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>

      </div>
    </nav>


        <!-- gestion des messages de session par modal -->


    <!-- trigger modal if messages exist -->

    <script type="text/javascript">
      <?php if (Session::getSession()->hasMessages() ) {?>
        var messagesData = '<?php echo "json_encode( Site::getSession()->getMessages() )";?>';
      <?php }else{?>
        var messagesData = '<?php echo "{\"success\": \"test success message\" , \"error\": \"test error message\"}";?>';
      <?php }?>
      messagesData = JSON.parse(messagesData);
      for (var key in messagesData) {
        // alert(key , messagesData[key] );
        console.log(key + " -> " + messagesData[key]);
      }
    </script>
    

    <!-- Button debug trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#messageModal"> debug modal </button>
    
    <!-- messageModal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="modaleTitle" aria-hidden="false">
      <div class="modal-dialog .modal-notify  <?php ?>modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modaleTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="message"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>