<?php

namespace App\Base\Contracts;

interface Request
{
    public function attributes();
    public function rules();
    public function process();
}