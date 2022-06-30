$(document).ready(function () {
    $(".btn[name='action']").click(function (e){
        if($(this).val() == "Rifornisci"){
            const url = new URL(window.location.href);
            const cod = url.searchParams.get("id");
            $.get(
                "processa-modifiche.php",
                {
                    CodProdotto: cod,
                    action: "rifornimento",
                },
                function (data) {
                  if (data.length > 0) {
                    $("#QtaInMagazzino").text(data);
                  }
                }
              );
        }
    });

    $(".btn.back").click(function (e) { 
      window.location.href = "./prodotti-compagnia.php";
    });
})