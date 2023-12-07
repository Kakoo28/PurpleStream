<?php

namespace PurpleStream\Controllers;
use PurpleStream\models\CategoryManager;

class CategoryController
{
    // On déclare un attribut de type ServiceManager
    private $categoryManager;

    // Méthode constructeur de la classe
    public function __construct()
    {
        // On instancie un objet de type ServiceManager
        $this->categoryManager = new CategoryManager();
    }

    // Cette fonction renvoie la liste de toutes les catégories
    public function getAll()
    {
        // Appelle la méthode getAll de ServiceManager pour récupérer toutes les catégories
       return $this->categoryManager->getAll();

    }
}