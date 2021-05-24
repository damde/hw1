<body>
    <?php
    include('./header.php');
    ?>

    <head>
        <script src="scripts/search.js" defer></script>
    </head>
    <div class="column">
        <div id="search">
            <h2>Ricerca</h2>
            <form action="#" id="search">
                <label for="text">Inserisci una parola chiave:</label>
                <input type="text" name="text" id="text">
                <input type="submit" value="Cerca">
            </form>
        </div>
    </div>
    <div class="column">
        <section class="showroom">
            <h2>Risultati ricerca</h2>
                <div class="verticalCards" id="products">
            </div>
        </section>
    </div>
    <?php
    include("./footer.php");
    ?>
</body>