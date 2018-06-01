<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class PagesController
{
    public function index()
    {
        return new Response('Salut les Geeks');
    }
}
