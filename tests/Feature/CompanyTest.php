<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     * */
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user manually
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin);
    }

    public function test_company_can_be_created()
    {
        $response = $this->post('/companies/ajax/store', [
            'name' => 'Test Company',
            'email' => 'test@example.com',
            'website' => 'https://example.com',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
            'email' => 'test@example.com',
        ]);
    }

    public function test_company_can_be_updated()
    {
        $company = Company::create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'website' => 'https://old.com',
        ]);

        $response = $this->post('/companies/ajax/store', [
            'id' => $company->id,
            'name' => 'New Name',
            'email' => 'new@example.com',
            'website' => 'https://new.com',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'name' => 'New Name',
        ]);
    }

    public function test_company_can_be_deleted()
    {
        $company = Company::create([
            'name' => 'Delete Me',
            'email' => 'delete@example.com',
            'website' => 'https://delete.com',
        ]);

        $response = $this->post('/companies/ajax/delete', ['id' => $company->id]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }

}
