<?php

namespace PurpleStream\Controllers;

use PurpleStream\models\LanguageManager;

class LanguageController
{

    // On déclare un attribut de type ServiceManager
    private $languageManager;

    // Méthode constructeur de la classe
    public function __construct()
    {
        // On instancie un objet de type ServiceManager
        $this->languageManager = new LanguageManager();
    }

    // Cette fonction renvoie la liste de toutes les catégories
    public function getAll()
    {
        // Appelle la méthode getAll de ServiceManager pour récupérer toutes les catégories
        return $this->languageManager->getAll();

    }

}