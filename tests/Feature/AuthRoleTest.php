<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_bisa_akses_dashboard_admin()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_admin_tidak_bisa_akses_dashboard_evaluator()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get(route('evaluator.dashboard'));
        $response->assertStatus(403);
    }

    public function test_evaluator_bisa_akses_dashboard_evaluator()
    {
        $evaluator = User::factory()->create(['role' => 'evaluator']);
        $response = $this->actingAs($evaluator)->get(route('evaluator.dashboard'));
        $response->assertStatus(200);
    }

    public function test_evaluator_tidak_bisa_akses_dashboard_admin()
    {
        $evaluator = User::factory()->create(['role' => 'evaluator']);
        $response = $this->actingAs($evaluator)->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_tamu_tidak_bisa_akses_dashboard()
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect('/login');

        $response2 = $this->get(route('evaluator.dashboard'));
        $response2->assertRedirect('/login');
    }
}
