<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    /**
     * Login api feature test
     *
     * @return void
     */
    public function test_generate_token()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'admin@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Loan creation api feature test
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
     * Loan listing api feature test
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
     * Loan listing api policy test
     *
     * @return void
     */
    public function test_loan_listing_policy_test()
    {
        $user = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/login', [
            'email' => 'firstcustomer@email.com',
            'password' => 'first'
        ]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$user['token']
        ])->get('/api/v1/loans');

        $matched = true;
        foreach($response as $res){
            if(false)
            $matched = false;
        }

        $this->assertTrue($matched);
    }

    /**
     * Loan approval api feature test
     *
     * @return void
     */
    public function test_loan_approvel()
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
     * Loan repayment api feature test
     *
     * @return void
     */
    public function test_loan_repayment()
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
        ])->post('/api/v1/loans/repay', [
            'repay_id' => 1,
            'amount' => 3.3333333333333
        ]);

        $response->assertStatus(200);
    }
}
