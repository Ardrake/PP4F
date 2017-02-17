$(document).ready(function() {
  $("#blanks form").submit(function(event) {
    var nomInput = $("input#nom").val();
    var ageInput = $("input#age").val();
    var element = document.getElementById("dessin");
    var elementValue = element.options[element.selectedIndex].text;

    $(".leNom").text(nomInput);
    $(".leAge").text(ageInput);
    $(".leDessin").text(elementValue);

    event.preventDefault();
  });
});
