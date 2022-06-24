$(document).ready(function () {
    $(".btn[name='action']").click(function (e){
        if($(this).val() == "Annulla acquisto"){
            $.post(
                "./gestione-carrello.php",
                {
                    action: "Annulla acquisto"
                }
                
            ).done(function (){
                window.location.href = "./carrello.php";
            })
        }else if($(this).val() == "Conferma acquisto"){
            console.log("test");
            $.post(
                "./gestione-carrello.php",
                {
                    action: "Conferma acquisto"
                },
                function(data){
                    switch(data){
                        case "Errore login":
                            windows.location.href = "./login.php";
                            break;
                        case "Errore ordine":
                            window.location.href = "./carrello.php";
                            break;
                        default:
                            // $.post(
                            //     "./processa-consegna-ordine.php",
                            //     {
                            //         orderID : data
                            //     }
                            // );
                            // window.location.href = "./dettaglio-ordine.php?" + data;
                            console.log(data);
                    }
                }
                
            )
        }
    });
})