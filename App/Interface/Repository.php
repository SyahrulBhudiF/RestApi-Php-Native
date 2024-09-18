<?php

namespace App\Interface;

interface Repository
{
    public function index(): void;

    public function show($id): void;

    public function store(): void;

    public function update($id): void;

    public function destroy($id): void;
}