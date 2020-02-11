$(document).ready(function() {
    $('#search-produit').keyup(function() {
        $('#result-search').html(''); //permet de mettre à blanc le résultat de notre recherche à chaque fois que nous effectuerons un appui

        var utilisateur = $(this).val(); //permets de récupérer notre saisie.

        if (utilisateur != "") {
            $.ajax({
                type: 'GET', // type de methode pour récuperer nos donnée
                url: 'searchbar/ProduitsController', // Url de la page a la quel on s'adresse
                data: 'user=' + encodeURIComponent(produits),
                success: function(data) {
                    if (data != "") { // si ma donnée es vide affiche
                        $('#result-search').append(data);
                    } else {
                        document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucun produits</div>" //aucun produits
                    }
                }
            });
        }
    });
});