<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class LoginTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_access_return_true(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * ログインページへのアクセステスト
     *
     * @return void
     */
    public function test_access_login_page(): void
    {
        $response = $this->get('login');

        $response->assertStatus(200);
    }

    /**
     * adminのログインテスト
     *
     * @return void
     */
    public function test_login_admin(): void
    {
        $response = $this->get('login');
        $user = new User;
        $admin = $user->find(1);

        $response = $this->postJson(route('loginResult', ['email' => $admin['email'], 'password' => 'admin']));

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    /**
     * 学校代表者のログインテスト
     *
     * @return void
     */
    public function test_login_representative(): void
    {
        $response = $this->get('login');
        $user = new User;
        $representative = $user->query()
            ->where('name', 'ソクラテス')
            ->first();

        $response = $this->postJson(route('loginResult', ['email' => $representative['email'], 'password' => 'Socrates']));
        $response->assertStatus(302);
        $response->assertRedirect('/articles');
        $this->assertAuthenticatedAs($representative);
    }

    /**
     * 学校関係者のログインテスト
     *
     * @return void
     */
    public function test_login_school_official(): void
    {
        $response = $this->get('login');
        $user = new User;
        $school_official = $user->query()
            ->where('name', '田辺 花子')
            ->first();

        $response = $this->postJson(route('loginResult', ['email' => $school_official['email'], 'password' => 'password']));
        $response->assertStatus(302);
        $response->assertRedirect('/articles');
        $this->assertAuthenticatedAs($school_official);
    }

    /**
     * 保護者のログインテスト
     *
     * @return void
     */
    public function test_login_parent(): void
    {
        $response = $this->get('login');
        $user = new User;
        $parent = $user->query()
            ->where('name', '藤本 美加子')
            ->first();

        $response = $this->postJson(route('loginResult', ['email' => $parent['email'], 'password' => 'password']));
        $response->assertStatus(302);
        $response->assertRedirect('/articles');
        $this->assertAuthenticatedAs($parent);
    }

    /**
     * code page access test
     *
     * @return void
     */
    public function test_access_code(): void
    {
        $response = $this->get('code');

        $response->assertStatus(200);
    }

    /**
     * signup page access test
     *
     * @return void
     */
    public function test_access_signup():void
    {
        $response = $this->getJson(route('signup', ['school_id' => 1, 'school_name' => 'test']));

        $response->assertStatus(200);
    }
}
