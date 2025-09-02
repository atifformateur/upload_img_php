<?php


//recuperer toutes les voitures
function get_all_cars()
{
    $query = "SELECT * FROM voitures";
    return db_select($query);
}