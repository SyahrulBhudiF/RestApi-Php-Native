<?php

namespace App\Interface;

interface Service
{
    public function index(): array|string;

    public function show($id): array|string|object;

    public function store(object $data): bool|string;

    public function update($id, $data): bool|string;

    public function destroy($id): bool|string;
}