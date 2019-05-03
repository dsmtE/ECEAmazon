/* 
 * A page can't be manipulated safely until the document is "ready."
 * $( document ).ready() will only run once the page Document Object Model (DOM) is ready for JavaScript code.
 */
 
$(function() { // Shorthand for $(document).ready() with jQuery
    console.log( "DOM ready!" );

    // ajout la class "active" à l'element ciblant la page active
    //on recupere le dernier element du split ave .pop() ce qui permet de recuperer tout la fin de la chaine apres le dernier / de l'url
    $('nav a[href$="' +location.pathname.split("/").pop() + '"]').addClass('active text-info');

    if($('#messageModalShow').length) {// si il y a des message d'erreur dans la modal
        $('#messageModal').modal('show');
    }

    $("#caraAdd").click(function() {
        var caraSelect = $( "#selectCara" ).val();
        console.log('#caraChoix_'+caraSelect);
        $ ('#caraChoix_'+caraSelect).show();
    });

    $("#caraDel").click(function() {
        var caraSelect = $( "#selectCara" ).val();
        console.log('#caraChoix_'+caraSelect);
        $ ('#caraChoix_'+caraSelect).hide();
    });

    $('#selectedUser').change(function() {
        console.log($(this).val());
        $(location).attr("href","http://localhost/ECEAmazon/modificationUsers.php?selectedUser="+$(this).val());

    });
    

});