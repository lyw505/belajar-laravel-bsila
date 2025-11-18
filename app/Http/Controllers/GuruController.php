<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuruRequest;
use App\Services\GuruService;

class GuruController extends Controller
{
    protected $service;

    public function __construct(GuruService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(StoreGuruRequest $request)
    {
        $this->service->createGuru($request->validated());
        return redirect()->route('login')->with('success', 'Registrasi guru berhasil! Silakan login.');
    }
}