<?php

try {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'mydb';

    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // La description des élèves + informations
    $request = $pdo->prepare("
        SELECT eleve.prenom, eleve.nom, eleve.login, eleve_information.rue, eleve_information.cp, eleve_information.ville, eleve_information.pays
        FROM eleve
        INNER JOIN eleve_information ON eleve.information_id = eleve_information.id
    ");

    if ($request->execute()) {
        echo "<pre>";
        print_r($request->fetchAll());
        echo "</pre>";
    }

    // Niveau de compétence des élèves
    $request = $pdo->prepare("
        SELECT eleve_competence.niveau, competence.titre, competence.description, eleve.nom, eleve.prenom
        FROM eleve_competence
        INNER JOIN eleve ON eleve_competence.eleve_id = eleve.id
        INNER JOIN competence ON eleve_competence.eleve_id = competence.id
    ");

    if ($request->execute()) {
        echo "<pre>";
        print_r($request->fetchAll());
        echo "</pre>";
    }
}

catch (Exception $exception) {
    echo $exception->getMessage();
}