<?php

namespace Tests\Application;

use PHPUnit\Framework\TestCase;

class AuthServiceTest extends TestCase
{
    /**
     * Summary of testPasswordGetsHashed
     * @test
     * @return void
     */
    public function testPasswordGetsHashed()
    {
        $password = '123456';

        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $this->assertTrue(
            password_verify($password, $hashed)
        );
    }
}