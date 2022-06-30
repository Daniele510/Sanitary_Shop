$(document).ready(function () {
  $(".btn[name='action']").click(function (e){
    if($(this).val() == "Aggiungi al carrello"){
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
          }
        );
    }else if($(this).text().split('(')[0] == "Vai alla cassa"){
      $.post(
        "./gestione-carrello.php",
        {
          action: "Vai alla cassa"
        },
        function(data) {
          if(data.length > 0){
            //messaggio errore
          }else{
            window.location.href = "./acquisto.php";
          }
        }
      );
    }
  });
  $('#risultato > ul').on("click",".delete" , function (e) {
    $.post(
      "./gestione-carrello.php",
      {
        id_prodotto: $("input[name='id_prodotto']").val(),
        id_fornitore: $("input[name='id_fornitore']").val(),
        action: "Elimina prodotto"
      },
      function(data) {
        if(data.length > 0){
            const parse  = JSON.parse(data);
            $("h1").text("Totale: " + parse["totale"]);
            $("#risultato > ul").html(parse["lista-prodotti"]);
            $("#cartButton").text(parse["num-articoli"]);
        }
      }
    );
  });

  

  const updateOptions = debounce(function (id_prod,id_forn,qta){
    $.post(
      "./gestione-carrello.php",
      {
        action: "Aggiorna quantità",
        id_prodotto : id_prod,
        id_fornitore : id_forn,
        quantità : qta
      },
      function(data) {
        if(data.length > 0){
          $("h1").text("Totale: " + data)
        }
      }
    );
  })

  $('#risultato > ul').on("input","input[name='Qta']", function (e){
    const codProdotto = $(e.target).parent().next("input[type='hidden']").val();
    const codFornitore = $(e.target).parent().next("input[type='hidden']").next().val();
    updateOptions(codProdotto,codFornitore,$(e.target).val());
  })

  function debounce(cb, delay = 250) {
    let timeout
  
    return (...args) => {
      clearTimeout(timeout)
      timeout = setTimeout(() => {
        cb(...args)
      }, delay)
    }
  }

});



