<?php
$connexion = new PDO("mysql:host=localhost:3307;dbname=backend_angular_dw1_22;charset=UTF8", "root", "");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
