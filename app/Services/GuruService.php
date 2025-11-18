<?php

namespace App\Services;

use App\Repositories\GuruRepository;

class GuruService
{
    protected $repo;

    public function __construct(GuruRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createGuru(array $data)
    {
        return $this->repo->create($data);
    }
}
