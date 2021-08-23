<?php

namespace App\Repositories;

interface PageRepositoryInterface
{
    public function published();

    public function all();

    public function allWithMeta();

    public function requestDataStore($request);

    public function requestDataUpdate($request, $page);
}
