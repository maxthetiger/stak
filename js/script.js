// Window load event used just in case window height is dependant upon images
$(window).bind("load", function() { 
       
       var footerHeight = 0,
           footerTop = 0,
           $footer = $("#footer");
           
       positionFooter();
       
       function positionFooter() {
       
                footerHeight = $footer.height();
                footerTop = ($(window).height()-footerHeight)+"px";
       
               if ( ($(document.body).height()+footerHeight) < $(window).height()) {
                   $footer.css({
                        position: "absolute"
                   }).animate({
                        bottom: 0,
                   })
               } else {
                   $footer.css({
                        position: "static"
                   })
               }
               
       }

       $(window)
               .scroll(positionFooter)
               .resize(positionFooter)
               
});


app = {

  /*
   * Chargement du DOM
   */
  init: function() {

    // Autocompletion d'adresse
    this.adresses()

  },


  /*
   * Autocomplete du champ adresse
   */
  adresses: function() {

    // On choppe notre input
    var input = document.getElementById("location")

    // Paramètres
    var options = {
      types: ['(cities)'],
    }

    // On ajoute l'autocomplete
    var autocomplete = new google.maps.places.Autocomplete(input, options)

    // Lors de la sélection d'adresse, on récupère les coordonnées
    google.maps.event.addListener(autocomplete, 'place_changed', function() {

      // On récupère
      var loc = autocomplete.getPlace().geometry.location

      // On traduit l'info dans un objet compréhensible par OpenWeather
      var data = {
        lat: loc.lat(),
        lon: loc.lng()
      }
    })
  },
}

/*
 * Chargement du DOM
 */
$(function() {
  app.init()
})