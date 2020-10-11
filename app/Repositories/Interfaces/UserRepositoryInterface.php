<?php


namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{
    public function all();

    public function getCurrentUser();

    public function getSettings();

    public function getRoles();
}
