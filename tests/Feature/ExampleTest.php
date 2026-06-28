<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Halaman login dapat diakses oleh pengunjung yang belum login.
     */
    public function test_halaman_login_dapat_diakses(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
