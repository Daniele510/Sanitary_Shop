$(document).ready(function () {
  $(".btn[type='submit']").click(function (e){
    if($(this).val() != "Acquista ora"){
      e.preventDefault();
      $.post(
          "./gestione-carrello.php",
          {
              id_prodotto: $("input[name='id_prodotto']").val(),
              id_fornitore: $("input[name='id_fornitore']").val(),
              quantità: $("input[name='quantità']").val(),
              action: $(this).val(),
          },
          function (data) {
            if (data.length > 0) {
              if(data == 1){
                  $('li.nav-item:nth-child(2)>a').addClass("shake")
                  setTimeout(()=>{
                      $('.shake').removeClass("shake");
                  },650);
              }
            }
            console.log(data);
          }
        );
    } 
  });
});