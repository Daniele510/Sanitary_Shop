$(document).ready(function () {
  const cellPattern = /\d{3}[\s-]?\d{3}[\s-]?\d{4}/gm;
  const partitaIVAPattern = /\d{7}[\s-]?\d{1}[\s-]?\d{3}/gm;
  const cittaPattern = /[a-zA-Z\-]+\s[a-zA-Z\-]+\s\d{5}/gm;
  const paesePattern = /[a-zA-Z\-]/gm;
  const emailPattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/gm;
  const pswPattern =
    /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/gm;

  $(".registration > form").submit(function (e) {
    if (!partitaIVAPattern.test($("#validationIVANum").val())) {
      e.preventDefault();
      $("#validationIVANum").attr(
        "title",
        "la partita iva deve contentere solo numeri, può essere suddiviso in gruppi da 7-1-3 cifre separate da spazio o -"
      );
    }
    if (!cellPattern.test($("#validationPhoneNum").val())) {
      e.preventDefault();
      $("#validationPhoneNum").attr(
        "title",
        "Il numero di telefono deve contenere solo numeri, può essere suddifivo in gruppi da 3-3-4 cifre separate da spazio o -"
      );
    }
    if (!cittaPattern.test($("#validationCity").val())) {
      e.preventDefault();
      $("#validationCity").attr(
        "title",
        "Il nome della citta e quello della prvincia possono essere solo lettere, nel caso di nomi composti utilizzare il carattere - per separarli, mentre il CAP contiene solo 5 numeri"
      );
    }
    if (!paesePattern.test($("#validationCountry").val())) {
      e.preventDefault();
      $("#validationCountry").attr(
        "title",
        "Il nome del paese deve contenere solo lettere, nel caso di nome composto utilizzare il carattere - pere separare"
      );
    }
    if (!emailPattern.test($("#validationEmail").val())) {
      e.preventDefault();
      $("#validationEmail").attr(
        "title",
        "L'indirizzo email deve seguire l'ordine: caratteri@caratteri.dominio; il domionio deve contenere almeno 2 lettere dalla 'a' alla 'z'"
      );
    }
    if (!pswPattern.test($("#validationPassword").val())) {
      e.preventDefault();
      $("#validationEmail").attr(
        "title",
        "La password deve contenere almeno un numero, una lettera maiuscola, una lettera minuscola, un carattere speciale, e deve essere almeno lunga 8 caratteri"
      );
    }
  });
});
