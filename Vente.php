<?php

// We include the header on our page

require_once("Composants/Header.php");

// We include the background of the site

require_once("Composants/BackgroundFixed.php");

// Include the database

require_once("Composants/Database.php");

// We retrieve our cars from the database

$sql = "SELECT * FROM voitures";
$requete = $db->query($sql);
$voitures = $requete->fetchAll();

// We create the div to contain our cars

?>

<div class='page'>
<h2 class='big-title'>Vente de voitures</h2>

<form id="filterForm" class="form">
  <div class="bloc-form">
    <label for="priceRange">Prix maximum :</label>
    <span id="spanPrice">0</span>
  </div>
  <div class="bloc-form">
    <input type="range" id="priceRange" name="priceRange" min="0" max="500000" step="1000" value="0">
  </div>
  <div class="bloc-form">
    <label for="mileageRange">Kilométrage maximum :</label>
    <span id="spanKm">0</span>
  </div>
  <div class="bloc-form">
    <input type="range" id="mileageRange" name="mileageRange" min="0" max="200000" step="10000" value="0">
  </div>
  <div class="bloc-form">
    <label for="yearRange">Année maximum :</label>
    <span id="spanYear">0</span>
  </div>
  <div class="bloc-form">
    <input type="range" id="yearRange" name="yearRange" min="1990" max="2023" step="1" value="0">
  </div>
</form>

<div id="carList">
  <!-- List of cars -->
</div>

<?php

// We include the footer on the page

require_once("Composants/Footer.php");

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

      // When the value of the input changes

      $('#priceRange, #mileageRange, #yearRange').on('input', function() {
        var price = $('#priceRange').val();
        var mileage = $('#mileageRange').val();
        var year = $('#yearRange').val();
        
        document.getElementById('spanPrice').innerHTML = price ;
        document.getElementById('spanKm').innerHTML = mileage ;
        document.getElementById('spanYear').innerHTML = year ;
        
    // Sending the AJAX request

    $.ajax({
      url: 'fetch_cars.php', // The PHP file to retrieve the cars
      method: 'POST',
      data: { price: price, mileage: mileage, year: year },
      success: function(response) {

        // Update car list

        $('#carList').html(response);
      }
    });
  });
});


</script>

