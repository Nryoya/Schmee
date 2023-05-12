<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class SignUpTest extends TestCase
{
    
    /**
     * コードページへのアクセステスト
     *
     * @return void
     */
    public function test_access_code(): void
    {
        $response = $this->get('code');

        $response->assertStatus(200);
    }

    /**
     * コードページのpostテスト
     *
     * @return void
     */
    public function test_submit_code(): void
    {
        $response = $this->get('code');
        $code = 'B114221820072';

        $response = $this->postJson(route('check', ['code' => $code]));

        $response->assertStatus(302);
        $response->assertLocation('http://localhost:8888/signup/4/%E7%B6%BE%E7%80%AC%E5%B8%82%E7%AB%8B%E5%8C%97%E3%81%AE%E5%8F%B0%E5%B0%8F%E5%AD%A6%E6%A0%A1');
    }

    /**
     *サインアップページアクセステスト
     *
     * @return void
     */
    public function test_access_signup(): void
    {
        $response = $this->getJson(route('signup', ['school_id' => 1, 'school_name' => 'test']));

        $response->assertStatus(200);
    }

    public function test_submit_user_insert(): void
    {
        $response = $this->getJson(route('signup', ['school_id' => 4, 'school_name' => '綾瀬市立北の台小学校']));

        $user_data = [
            'name' => 'test',
            'email' => 'test@test.test',
            'password' => 'password',
            'schools_id' => 4,
            'role' => 0,
        ];

        $response = $this->postJson(route('insert', $user_data));

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'test@test.test',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('firstRegister');
    }

}
