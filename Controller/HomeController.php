<?php

namespace Controller;

class HomeController
{
    public function index(): void
    {
        render('home', ['title' => 'Portfolio']);
    }
}
