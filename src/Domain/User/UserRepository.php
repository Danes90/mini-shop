<?php

namespace App\Domain\User;

interface UserRepository
{
    public function save(array $user): void;
    public function findByEmail(string $email): ?array;
}