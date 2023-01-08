<?php
include "LogginManager.php";
include "Database.php";
include "OutputFormator.php";
include "BasketManager.php";

include_once "NakupnyKosikHeader.php";
$loginManager = new LogginManager();

$db = new Database();
$outputFormator = new OutputFormator();
$basketManager = new BasketManager();
$idNakupujuceho = $_SESSION['ipcka'];

if ($_SESSION['logged'] == 1) {
    $pouzivatel = $db->nacitajInfoUzivatela($_SESSION['sesMail']);
    $idNakupujuceho = $pouzivatel->id;
}
$produktyKosiku = $db->dajProduktyNakupnehoKosika($idNakupujuceho);



echo $idNakupujuceho;
if (isset($_GET['deleteBasket'])) {
    if ($_GET['deleteBasket'] == 1) {
        $db->vyprazdniKosik($idNakupujuceho);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name = "viewport" content ="with=device-width, initial-scale=1.0">
    <title>Supplement engineer</title>
    <link rel="stylesheet" href="css/MainPage.css">
    <meta charset="UTF-8">


</head>

<script type="text/javascript">
    function changePrize(index, maximalLength) {

        var celkovaCena = 0.0;

        var pocetKusov = document.getElementById(index).value.trim();

        var obj = new XMLHttpRequest();

        obj.open("GET", "home.txt", true);

        obj.send();

        var idMenenej = document.getElementById(index + "id").value.trim();

        var aktualnaCena = document.getElementById("cenaPolozky" + index).innerHTML;
        aktualnaCena = makeDoubleOfInput(aktualnaCena);
        aktualnaCena = aktualnaCena * pocetKusov;

        celkovaCena += parseFloat(aktualnaCena);

        for (let i = 0; i < maximalLength; i++) {
            if (index != i) {
                var celkovaCenaPolozky = document.getElementById("celkovaCenaPolozky" + i.toString()).innerHTML;
                celkovaCenaPolozky = makeDoubleOfInput(celkovaCenaPolozky);

                celkovaCena += parseFloat(celkovaCenaPolozky);
            }


        }

        obj.onreadystatechange = function () {

            aktualnaCena = formatOutputFromDouble(aktualnaCena);

            document.getElementById("celkovaCenaPolozky" + index).innerHTML = aktualnaCena;

            var cenaBezDph = celkovaCena;

            celkovaCena = formatOutputFromDouble(celkovaCena);

            document.getElementById("cenaDokopy").innerHTML = celkovaCena + " with VAT";

            cenaBezDph = cenaBezDph * 0.8;

            cenaBezDph = formatOutputFromDouble(cenaBezDph);

            document.getElementById("cenaBezDph").innerHTML = cenaBezDph + " without VAT";

            obj.open("GET", "aktualizujPocetKusov.php?pocet=" + pocetKusov + "&idPolozky=" + idMenenej, true);
            obj.send();
        }

    }

    function makeDoubleOfInput(number) {
        number = number.slice(0, -2);
        number = number.replace(",", ".");

        return number;
    }

    function formatOutputFromDouble(input) {
        input = input.toFixed(2);
        input = input.replace(".", ",");
        input = input + " €";

        return input;
    }

</script>

<section class = "header" >

    <?php

    $loginManager->setLayout();

    ?>


    <div class = "basket">
        <h1>Shoping basket</h1>


        <div class = "columns">
            <h3>Name of product</h3>

            <h2>Number of pieces</h2>

            <h1>Prize</h1>

            <h1>Total prize</h1>

        </div>

    </div>


    <div class = "basketProducts">
    <?php

    $i = 0;
    foreach ($produktyKosiku as $jednaPolozka) {

        $idAktualneho = $jednaPolozka->getIdProduktu();
        $jednaPolozka->getIdPouzivatela();
        $aktualnyProdukt = $db->dajProduktPodlaId($idAktualneho);
        $dostupnyPocet = $db->dajPocetProduktovNaSkladePodlaIdABalenia($idAktualneho, $jednaPolozka->getBalenie());

        ?>

        <div class = "oneProduct">
            <img src=<?php echo $aktualnyProdukt->getCestaKObrazku()?>>
            <a href="?chosenProduct=<?php echo $idAktualneho?>"><?php echo $aktualnyProdukt->getNazovProduktu()?></a>



            <?php
            $dolnyRiadok = $jednaPolozka->getBalenie()." g";

            if ($jednaPolozka->getPrichut() != null)
            $dolnyRiadok = $dolnyRiadok.",".$jednaPolozka->getPrichut();

            {?>
                <h2><?php echo $dolnyRiadok?></h2>
            <?php }?>

            <form id="pocetKusovProduktu" method="post">
                <label for="pocetKusovProduktu"></label>
                <input type="number" name=<?php echo $i?> id=<?php echo $i?> min="1" max=<?php echo $dostupnyPocet?> onchange="changePrize(<?php echo $i?>, <?php echo sizeof($produktyKosiku)?>)" value=<?php echo $jednaPolozka->getPocetKusov()?> >
                <input type="hidden" name=<?php echo $i."id"?> id=<?php echo $i."id"?> value="<?php echo $jednaPolozka->getId()?>"/>

            </form>
            <h3 id=<?php echo "cenaPolozky".$i?>> <?php echo $outputFormator->editPrize($jednaPolozka->getCena())?></h3>

            <h4 id=<?php echo "celkovaCenaPolozky".$i?>> <?php echo $outputFormator->editPrizeForMultipleItems($jednaPolozka->getCena(), $jednaPolozka->getPocetKusov())?></h4>




            <div class="deleteOption">
                <a href="?deletedItem=<?php echo $jednaPolozka->getId()?>"> Delete</a>


            </div>



        </div>


    <?php $i++;} ?>

        <div class="zuctovanie">


            <div class="pokracuj">
                <a href="index.php"> Continue shopping</a>
            </div>



            <?php if (sizeof($produktyKosiku) != 0 ) {?>
            <div class="zmazVsetko">
                <a href="?deleteBasket=1">Empty the basket</a>
            </div>

            <h1>Together: </h1>
            <h2 id="cenaDokopy"><?php echo $basketManager->getTotalPrizeWithDPH($produktyKosiku)?></h2>
            <h3 id="cenaBezDph"><?php echo $basketManager->getTotalPrizeWithoutDPH($produktyKosiku)?></h3>


            <form>
                <input name="makeOrderBtn" type="submit" value="ORDER">
            </form>

            <?php } ?>

        </div>

    </div>












    <?php
    include_once "sideCategories.php";

    ?>

</section>


</body>
</html>