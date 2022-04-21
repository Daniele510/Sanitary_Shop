$(document).ready(function () {
  const updateSuggestion = throttle((text) => {
    // chiamata ajax al db
    $.post("../../Sanitary_Shop/gestione-suggerimenti.php", { NomeProdotto: text }, function (data) {
      const data_parse = JSON.parse(data);

      if (Object.keys(data_parse).length > 0) {
        $("#suggestions").html(data_parse["productsSeggestion"]);
      } else {
        $("#suggestions").html("");
      }
    });
  });

  $('input[type="search"]').on("input", (e) => {
    if (e.target.value.length > 0) {
      updateSuggestion(e.target.value);
    } else {
      $("#suggestions").html("");
    }
  });

  function throttle(cb, delay = 1000) {
    let shouldWait = false;
    let waitingArgs;
    const timeoutFunc = () => {
      if (waitingArgs == null) {
        shouldWait = false;
      } else {
        cb(...waitingArgs);
        waitingArgs = null;
        setTimeout(timeoutFunc, delay);
      }
    };

    return (...args) => {
      if (shouldWait) {
        waitingArgs = args;
        return;
      }

      cb(...args);
      shouldWait = true;

      setTimeout(timeoutFunc, delay);
    };
  }
});
