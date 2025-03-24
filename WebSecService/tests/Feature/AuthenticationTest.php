<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RoleService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login()
    {
        $response = $this->get('/');
        
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_login_redirects_admin_to_admin_dashboard()
    {
        $admin = User::factory()->create([
            'role' => RoleService::ADMIN,
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_unauthorized_access_is_blocked()
    {
        $customer = User::factory()->create([
            'role' => RoleService::CUSTOMER,
        ]);

        $response = $this->actingAs($customer)
            ->get('/admin/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect(route('customer.dashboard'));
        $response->assertSessionHas('error', 'You do not have permission to access this area.');
    }

    public function test_login_with_invalid_credentials_fails()
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
} 