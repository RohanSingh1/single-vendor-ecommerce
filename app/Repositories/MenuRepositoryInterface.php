<?php

namespace App\Repositories;

interface MenuRepositoryInterface
{
    public function selectedMenu();

    public function getMenus();

    public function find($menu);

    public function getPages();

    public function parent();
}
