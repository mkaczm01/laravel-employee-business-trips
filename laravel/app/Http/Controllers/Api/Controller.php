<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OAT;
use App\Http\Controllers\Controller as BaseController;

#[OAT\Info(
    version: '1.0.0',
    description: 'Recruitment Task - API',
    title: 'Recruitment Task - API',
    contact: new OAT\Contact(
        name: 'Mateusz Kaczmarek',
        url: 'https://www.linkedin.com/in/mateuszkaczmarek/',
        email: 'm_kaczmarek@outlook.com',
    ),
    license: new OAT\License(
        name: 'MIT',
    ),
)]
class Controller extends BaseController
{
}
