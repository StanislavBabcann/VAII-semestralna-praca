<?php
include_once "../Controller/sideCategoriesHeader.php";
?>


<head>
<meta name="viewport" content="width=device-width">
</head>

<script>

    const ids = ["myDropdown", "myDropdown2","myDropdown3","myDropdown4","myDropdown5","myDropdown6",
        "myDropdown7","myDropdown8","myDropdown9"];

    function myFunction(number) {
        deleteBeforeOpenedMenu();
        document.getElementById(ids[number]).classList.toggle("show");

    }



    function deleteBeforeOpenedMenu() {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            deleteBeforeOpenedMenu();
        }
    }



    var limitFunc = function(){
        if (window.outerWidth>816){

            document.getElementById("categories-box").style.left = "12vw";

        } else {
            document.getElementById("categories-box").style.left = "-30vw";
        }
    };

    window.addEventListener("resize", limitFunc);


</script>



<div id="categories-box" class="categories-box">



    <div class="dropdown">


            <button onclick="myFunction(0)" id = "prvy" class="dropbtn">PROTEINS</button>
            <div id="myDropdown" class="dropdown-content">
                <a href="?hlavnaKategoria=Protein%20powder">ALL</a>
                <a href="?podKategoria=Whey">WHEY</a>
                <a href="?podKategoria=Casein">CASEIN</a>
                <a href="?podKategoria=Blends">BLENDS</a>
                <a href="?podKategoria=Vegan">VEGAN</a>
                <a href="?podKategoria=Other%20protein">OTHER(BEEF, EGG...)</a>
            </div>
    </div>

    <div class="dropdown">


        <button onclick="myFunction(1)" id = "druhy" class="dropbtn">WEIGHT GAINERS</button>
        <div id="myDropdown2" class="dropdown-content">
            <a href="?hlavnaKategoria=Gainers">All</a>
            <a href="?podKategoria=Gainers">GAINERS</a>
            <a href="?podKategoria=Sacharids">SACHARIDS</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(2)" class="dropbtn">CREATINE</button>
        <div id="myDropdown3" class="dropdown-content">
            <a href="?hlavnaKategoria=Creatine">ALL</a>
            <a href="?podKategoria=Monohydrate">MONOHYDRATE</a>
            <a href="?podKategoria=Multi-component">MULTI-COMPONENT</a>
            <a href="?podKategoria=Other%20creatine">OTHER</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(3)" class="dropbtn">AMINO ACIDS</button>
        <div id="myDropdown4" class="dropdown-content">
            <a href="?hlavnaKategoria=Amino%20acids">ALL</a>
            <a href="?podKategoria=BCAA">BCAA</a>
            <a href="?podKategoria=Glutamine">GLUTAMINE</a>
            <a href="?podKategoria=Arginine">ARGININE</a>
            <a href="?podKategoria=Single%20creatine">SINGLE COMPONENT</a>
            <a href="?podKategoria=Multi%20creatine">MULTI COMPONENT</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(4)" class="dropbtn">PRE-WORKOUT PUMPS</button>
        <div id="myDropdown5" class="dropdown-content">
            <a href="?hlavnaKategoria=Pre-workout%20pumps">ALL</a>
            <a href="?podKategoria=With%20stimulants">WITH STIMULANTS</a>
            <a href="?podKategoria=Without%20stimulants">WITHOUT STIMULANTS</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(5)" class="dropbtn">FAT BURNERS</button>
        <div id="myDropdown6" class="dropdown-content">
            <a href="?hlavnaKategoria=Fat%20burners">ALL</a>
            <a href="?podKategoria=L-carnitine">L-CARNITINE</a>
            <a href="?podKategoria=Single%20burner">SINGLE COMPONENT</a>
            <a href="?podKategoria=Complex%20burner">COMPLEX</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(6)" class="dropbtn">JOINT NUTRITION</button>
        <div id="myDropdown7" class="dropdown-content">
            <a href="?hlavnaKategoria=Joint%20nutrition">ALL</a>
            <a href="?podKategoria=Single%20joint">SINGLE COMPONENT</a>
            <a href="?podKategoria=Multi%20joint">MULTI COMPONENT</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(7)" class="dropbtn">VITAMINS & MINERALS</button>
        <div id="myDropdown8" class="dropdown-content">
            <a href="?hlavnaKategoria=VITAMINS%20&%20MINERALS">ALL</a>
            <a href="?podKategoria=Single%20vitamin">SINGLE COMPONENT</a>
            <a href="?podKategoria=Multivitamin">COMPLEX</a>
            <a href="?podKategoria=Omega">OMEGA FATTY ACIDS</a>
        </div>


    </div>

    <div class="dropdown">


        <button onclick="myFunction(8)" class="dropbtn">CLOTHES</button>
        <div id="myDropdown9" class="dropdown-content">
            <a href="?hlavnaKategoria=Clothes">ALL</a>
            <a href="?podKategoria=t-shirt">T-SHIRT</a>
            <a href="?podKategoria=tank%20top">TANK TOP</a>
        </div>


    </div>



</div>





