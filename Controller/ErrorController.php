<?php

namespace Controller;

class ErrorController
{
    public function notFound(): void
    {
        http_response_code(404);
        render('errors/404');
    }

    public function forbidden(): void
    {
        http_response_code(403);
        render('errors/403');
    }
}
