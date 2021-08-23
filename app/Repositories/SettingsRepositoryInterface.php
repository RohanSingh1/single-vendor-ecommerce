<?php

namespace App\Repositories;

interface SettingsRepositoryInterface
{
    public function all();

    public function setTextTitle($request, $slug);

    public function setImage($request, $slug);
}
