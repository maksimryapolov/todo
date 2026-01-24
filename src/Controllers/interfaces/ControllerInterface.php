<?php

declare(strict_types=1);

namespace App\Controllers\interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{
    public function add(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}
