<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user manually
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($this->admin);
    }

    public function test_employee_can_be_created()
    {
        $company = Company::create([
            'name' => 'Test Company',
            'email' => 'company@example.com',
            'website' => 'https://company.com',
        ]);

        $response = $this->post('/employees/ajax/store', [
            'id' => null,
            'first_name' => 'Geo',
            'last_name' => 'Sid',
            'company_id' => $company->id,
            'email' => 'geo.sid@example.com',
            'phone' => '1234567890',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('employees', [
            'first_name' => 'Geo',
            'last_name' => 'Sid',
            'company_id' => $company->id,
        ]);
    }

    public function test_employee_can_be_updated()
    {
        $company = Company::create([
            'name' => 'Test Company',
            'email' => 'company@example.com',
            'website' => 'https://company.com',
        ]);

        $employee = Employee::create([
            'first_name' => 'Geo',
            'last_name' => 'Sid',
            'company_id' => $company->id,
            'email' => 'geo.sid@example.com',
            'phone' => '1234567890',
        ]);

        $response = $this->post('/employees/ajax/store', [
            'id' => $employee->id,
            'first_name' => 'Geo',
            'last_name' => 'Sid',
            'company_id' => $company->id,
            'email' => 'geo.sid@example.com',
            'phone' => '1234567890',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'first_name' => 'Geo',
            'email' => 'geo.sid@example.com',
        ]);
    }

    public function test_employee_can_be_deleted()
    {
        $company = Company::create([
            'name' => 'Test Company',
            'email' => 'company@example.com',
            'website' => 'https://company.com',
        ]);

        $employee = Employee::create([
            'first_name' => 'Delete',
            'last_name' => 'Me',
            'company_id' => $company->id,
            'email' => 'delete.me@example.com',
            'phone' => '0000000000',
        ]);

        $response = $this->post('/employees/ajax/delete', [
            'id' => $employee->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
