<?php


namespace App\Repositories\Interfaces;


interface OfferRepositoryInterface
{
    public function all($request);

    public function get($request);

    public function getLastNumber($request);

    public function getNewNumber($request);

    public function getData($id);
}
