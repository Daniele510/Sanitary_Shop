$(document).ready(function () {
  const cellPattern = /\d{3}[\s-]?\d{3}[\s-]?\d{4}/gm;
  const partitaIVAPattern = /\d{7}[\s-]?\d{1}[\s-]?\d{3}/gm;
  const cittaPattern = /[a-zA-Z\-]+\s[a-zA-Z\-]+\s\d{5}/gm;
  const paesePattern = /[a-zA-Z\-]/gm;
  const emailPattern = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/gm;
  const pswPattern =
    /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/gm;
  const cartaPattern = /\d{13,16}/gm;
  const dataPaatern = /\d{2}[\s-:]?\d{4}[\s-:]/gm;

  

  $("#registrazione-utente > form").submit(function (e) {
    if (!cellPattern.test($("#validationPhoneNum").val())) {
      e.preventDefault();
      $("#validationPhoneNum").attr(
        "title",
        "Il numero di telefono deve contenere solo numeri, può essere suddifivo in gruppi da 3-3-4 cifre separate da spazio o -"
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
    if (!cartaPattern.test($("#validationCard").val())) {
      e.preventDefault();
      $("#validationEmail").attr(
        "title",
        "Il codice della carta deve contenere dalle 13 alle 16 cifre, non sono permissi altri caratteri oltre alle cifre"
      );
    }
    if (!dataPaatern.test($("#validationDate").val())) {
      e.preventDefault();
      $("#validationDate").attr(
        "title",
        "La data è composta da due cifre che rappresentano il mese, seguite da 4 cifre che indicano l'anno, per separare mese e anno si può usare ':', '-' o spazio"
      );
    }
  });
});
