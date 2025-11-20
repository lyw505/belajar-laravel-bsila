<?php

namespace App\Services;

use App\Repositories\KbmRepository;

class KbmService
{
    protected $repo;

    public function __construct(KbmRepository $repo)
    {
        $this->repo = $repo;
    }

    public function createKbm(array $data)
    {
        return $this->repo->create($data);
    }
}
