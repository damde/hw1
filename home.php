<?php
session_start();
?>

<head>
  <title>Hotel NUMBERS</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link rel="stylesheet" href="./style/style.css">
  <script src="./scripts/loadHotels.js" defer></script>
  <meta charset="UTF-8">
</head>


<head>

</head>

<body>


  <?php
  include('./header.php');
  ?>

  <div class="column">
    <section class="showroom">
      <h2>Vetrina</h2>
      <div class="verticalCards" id="products">
      </div>
      <a id="all" href="#/">Mostra tutti</a>
    </section>
  </div>

  <?php
  include("./footer.php");
  ?>
</body>