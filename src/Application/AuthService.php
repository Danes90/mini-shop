<?php
use App\Domain\User\UserRepository;
use App\Infrastructure\Session\SessionManager;

class AuthService
{
    private UserRepository $repository;
    private SessionManager $session;

    public function __construct(
        UserRepository $repository,
        SessionManager $session
    ) {
        $this->repository = $repository;
        $this->session = $session;
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->repository->findByEmail($email);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        $this->session->set('user', $user['id']);

        return true;
    }