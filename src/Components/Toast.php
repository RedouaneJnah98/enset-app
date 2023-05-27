<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Toast
{
    public string $message;
    public string $type = 'success';
    public string $heading = 'Success';
    public string $color = '#62A786';
}