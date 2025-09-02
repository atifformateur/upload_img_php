<?php

function cars_index() {
    //d'aller chercher les cars en base de donnée
    $cars = get_all_cars();

    load_view_with_layout("cars/index", ["cars" => $cars]);
}

// parler a la base de donnée -> model
// afficher des choses -> view