$(document).ready(function () {
    $.post(
        "./gestione-carrello.php",
        {
            id_prodotto: $("input[name='id_prodotto']"),
            id_fornitore: $("input[name='id_fornitore']"),
            quantità: $("input[name='quantità']"),
        },
        function (data) {
          if (data.length > 0) {
            if(data == 1){
                $('li.nav-item:nth-child(2)>a').addClass("shake")
                setTimeout(()=>{
                    $('shake').removeClass("shake");
                },0.6);
            }
          }
        }
      );
});