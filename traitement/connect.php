<?php

////////////////////////
// CONNEXION A LA BDD //
////////////////////////

// VARIABLES DE CONNEXION A LA BASE DE DONNEES
const SERVER = "localhost";
const USER = "root";
const PASSWORD = "";
const BASE = "gestion_stock";

// CONNEXION A LA BASE DE DONNEES
try {
    $connexion = new PDO("mysql:host=" . SERVER . ";dbname=" . BASE, USER, PASSWORD);
    //echo "Connexion réussie";
} catch (Exception $e) {
    echo "ERREUR DE CONNEXION SQL: " . $e->getMessage();
}