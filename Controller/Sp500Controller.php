<?php

namespace Controller;

class Sp500Controller
{
    public function index(): void
    {
        render('sp500/accueil');
    }

    public function histoire(): void
    {
        render('sp500/histoire');
    }

    public function livret(): void
    {
        render('sp500/livret');
    }

    public function autres(): void
    {
        render('sp500/autres');
    }
}
