<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DarkModeTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_contains_anti_fouc_script_and_theme_toggle(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('emodul-theme', false);
        $response->assertSee('Pilihan tema tampilan', false);
        $response->assertSee('role="radiogroup"', false);
    }

    public function test_siswa_login_page_contains_anti_fouc_script_and_theme_toggle(): void
    {
        $response = $this->get('/siswa/login');

        $response->assertStatus(200);
        $response->assertSee('emodul-theme', false);
        $response->assertSee('Pilihan tema tampilan', false);
    }

    public function test_authenticated_dashboard_contains_anti_fouc_script_and_theme_toggle(): void
    {
        $guru = User::factory()->create([
            'role' => 'guru',
            'status' => 'active',
        ]);

        $response = $this->actingAs($guru)->get('/guru/dashboard');

        $response->assertStatus(200);
        $response->assertSee('emodul-theme', false);
        $response->assertSee('Pilihan tema tampilan', false);
    }

    public function test_error_page_contains_anti_fouc_script_but_no_theme_toggle(): void
    {
        $response = $this->get('/halaman-pasti-tidak-ada-404-xyz');

        $response->assertStatus(404);
        $response->assertSee('emodul-theme', false);
        $response->assertDontSee('Pilihan tema tampilan', false);
    }
}
