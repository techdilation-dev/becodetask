<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitTest extends TestCase
{
    /**
     * Unit test for admin login
     *
     * @return void
     */
    public function test_admin_login()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'admin@email.com',
            'password' => 'password'
        ]);

        $this->assertTrue(!is_null($response['token']));
    }

    /**
     * Unit test for customer login
     *
     * @return void
     */
    public function test_customer_login()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'firstcustomer@email.com',
            'password' => 'first'
        ]);

        $this->assertTrue(!is_null($response['token']));
    }

    /**
     * Unit test for loan creation
     *
     * @return void
     */
    public function test_loan_creation()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'firstcustomer@email.com',
            'password' => 'first'
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$response['token']
        ])->post('/api/v1/loans/create', [
            'amount' => '10.000',
            'term' => 3,
            'date' => '7th Oct 2022'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Unit test for loan listing
     *
     * @return void
     */
    public function test_loan_listing()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'firstcustomer@email.com',
            'password' => 'first'
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$response['token']
        ])->get('/api/v1/loans');

        $response->assertStatus(200);
    }

    /**
     * Unit test for loan approval
     *
     * @return void
     */
    public function test_loan_approval()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'admin@email.com',
            'password' => 'password'
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$response['token']
        ])->post('/api/v1/loans/approval', [
            'loan_id' => 1
        ]);

        $response->assertStatus(200);
    }

    /**
     * Unit test for loan repayment
     *
     * @return void
     */
    public function test_loan_repayment()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'admin@email.com',
            'password' => 'password'
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$response['token']
        ])->post('/api/v1/loans/approval', [
            'loan_id' => 1
        ]);

        $response->assertStatus(200);
    }
}
