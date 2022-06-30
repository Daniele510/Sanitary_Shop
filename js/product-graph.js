$(document).ready(function () {
      const data = {
        labels: [],
        datasets: [{
          label: 'Vendite',
          backgroundColor: 'rgba(50, 75, 75, 1)',
          borderColor: 'rgba(50, 75, 75, 1)',
          data: [],
        }]
      };
    
      const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                grid:[{
                    offset: true
                }]
            }
        }
      };

      const myChart = new Chart(
          $("#myChart"),
          config
      );
      
        const url = new URL(window.location.href);
        const id = url.searchParams.get("id");
        const value =  $("select[name='time'] option:selected").val();
        const last = value.split(' ')[0];
        const type = value.split(' ')[1];
        addData(id, type, last);

      $("select[name='time']").change(function (){
        const url = new URL(window.location.href);
        const id = url.searchParams.get("id");
        const value =  $("select[name='time'] option:selected").val();
        const last = value.split(' ')[0];
        const type = value.split(' ')[1];
        addData(id, type, last);
      });

      function addData(id_prod, type, last) {
        $.post(
            "../area-aziende/gestione-dati-grafico.php",
            {
                id_prodotto: id_prod,
                type: type,
                last: last,
            },
            function (data) {
              const data_parse = JSON.parse(data);
              if (Object.keys(data_parse).length > 0) {
                myChart.config.data.labels = data_parse["Date"];
                myChart.config.data.datasets[0].data = data_parse["NumProdottiVenduti"];
                myChart.update();
                let sum = 0;
                data_parse["NumProdottiVenduti"].forEach(element => {
                  sum+= parseInt(element);
                });
                console.log(sum);
                $("#TotVendite").text(sum);
              }
              
            }
          );
      } 
});

          