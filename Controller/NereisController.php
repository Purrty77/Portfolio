<?php

namespace Controller;

class NereisController
{
    public function index(): void
    {
        $title = 'Nereis - Accueil';
        $nereisPage = 'home';
        require __DIR__ . '/../Views/nereis/home.php';
    }

    public function femme(): void
    {
        $title = 'Nereis - Collection Femme';
        $nereisPage = 'femme';
        require __DIR__ . '/../Views/nereis/femme.php';
    }

    public function homme(): void
    {
        $title = 'Nereis - Collection Homme';
        $nereisPage = 'homme';
        require __DIR__ . '/../Views/nereis/homme.php';
    }

    public function panier(): void
    {
        $title = 'Nereis - Panier';
        $nereisPage = 'panier';
        require __DIR__ . '/../Views/nereis/panier.php';
    }
}
