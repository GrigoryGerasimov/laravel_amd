<?php

namespace Tests\Feature\Web;

use App\Models\{User, Role, Article, Brand, Color, Country, Season, Size};
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    /** @test */
    public function test_an_unauthenticated_user_cannot_access_amd_index_view(): void
    {
        $this
            ->withoutDeprecationHandling();

        $this->assertGuest();

        $response = $this->get('/articles');

        $response
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function test_only_an_authenticated_user_can_access_amd_index_view(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $dummyPassword = $this->faker()->password();

        $credentials = [
            'email' => 'test@test.com',
            'password' => $dummyPassword
        ];

        $user = User::create(array_merge(
            [
                'name' => $this->faker()->firstNameFemale() . $this->faker()->lastName(),
                'password_confirmation' => $dummyPassword
            ],
            $credentials
        ));

        $this->assertDatabaseCount('users', 1);

        $responseLoginGet = $this->get('/login');

        $responseLoginGet
            ->assertStatus(200)
            ->assertOk();

        $responseLoginPost = $this->post('/login', $credentials);

        $responseLoginPost
            ->assertStatus(302)
            ->assertRedirectToRoute('home');

        $this->assertAuthenticatedAs($user);

        $responseAmdIndex = $this->get('/articles');

        $responseAmdIndex
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('articles.index')
            ->assertSeeText('No article positions available');
    }

    /** @test */
    public function test_an_authenticated_user_without_creator_role_cannot_create_articles(): void
    {
        $users = User::factory(2)->create();
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 2);
        foreach ($users as $user) {
            $this->assertDatabaseHas('users', ['email' => $user->email]);
        }

        $firstUser = $users->first();
        $secondUser = $users->last();

        $managerRole = 'amd-manager';
        $creatorRole = 'amd-creator';

        $secondUser->roles()->attach(Role::where('slug', $managerRole)->get());

        $this->assertTrue($secondUser->hasRole($managerRole));
        $this->assertFalse($secondUser->hasRole($creatorRole));
        $this->assertFalse($firstUser->hasRole($creatorRole));

        $this
            ->actingAs($firstUser)
            ->get('/articles')
            ->assertViewIs('articles.index')
            ->assertDontSee(['Create New SKU', 'New SKU']);

        $this
            ->actingAs($secondUser)
            ->get('/articles')
            ->assertViewIs('articles.index')
            ->assertDontSee(['Create New SKU', 'New SKU']);
    }

    /** @test */
    public function test_an_amd_creator_can_create_a_new_article_position(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);

        $this
            ->assertDatabaseCount('brands', 2)
            ->assertDatabaseCount('colors', 17)
            ->assertDatabaseCount('countries', 2)
            ->assertDatabaseCount('permissions', 4)
            ->assertDatabaseCount('roles', 2)
            ->assertDatabaseCount('seasons', 1)
            ->assertDatabaseCount('sizes', 13);

        $user->roles()->attach(Role::where('slug', 'amd-creator')->get());

        $newArticleData = [
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'Test Position',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ];

        $this
            ->actingAs($user)
            ->post('/articles', $newArticleData)
            ->assertStatus(302)
            ->assertRedirectToRoute('amd.index');

        $this
            ->assertDatabaseCount('articles', 1)
            ->assertDatabaseHas('articles', ['supplier_article_name' => 'Test Position']);
    }

    /** @test */
    public function test_a_new_article_position_cannot_be_created_with_invalid_data(): void
    {
        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);

        $this
            ->assertDatabaseCount('brands', 2)
            ->assertDatabaseCount('colors', 17)
            ->assertDatabaseCount('countries', 2)
            ->assertDatabaseCount('permissions', 4)
            ->assertDatabaseCount('roles', 2)
            ->assertDatabaseCount('seasons', 1)
            ->assertDatabaseCount('sizes', 13);

        $user->roles()->attach(Role::where('slug', 'amd-creator')->get());

        $newArticleData = [
            'season_id' => Season::first()->id,
            'buying_article_sku' => 1,
            'buying_article_config' => 123,
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => '',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => false,
            'user_id' => $user->id
        ];

        $this
            ->actingAs($user)
            ->post('/articles', $newArticleData);

        $this
            ->assertDatabaseCount('articles', 0)
            ->assertDatabaseEmpty('articles')
            ->assertDatabaseMissing('articles', [
                'ean_gtin' => 'abcd12345dcba'
            ]);
    }

    /** @test */
    public function test_an_authenticated_user_without_manager_role_cannot_manage_edit_or_delete_articles(): void
    {
        $users = User::factory(2)->create();

        $this->seed(DatabaseSeeder::class);

        Article::create([
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'Test Position',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ]);

        $this->assertDatabaseCount('articles', 1);
        $this->assertDatabaseCount('users', 2);

        foreach ($users as $user) {
            $this->assertDatabaseHas('users', ['email' => $user->email]);
        }

        $firstUser = $users->first();
        $secondUser = $users->last();

        $managerRole = 'amd-manager';
        $creatorRole = 'amd-creator';

        $firstUser->roles()->attach(Role::where('slug', $creatorRole)->get());

        $this->assertFalse($firstUser->hasRole($managerRole));
        $this->assertFalse($secondUser->hasRole($managerRole));
        $this->assertTrue($firstUser->hasRole($creatorRole));

        $this
            ->actingAs($firstUser)
            ->get('/articles/' . Article::first()->id)
            ->assertViewIs('articles.show')
            ->assertDontSee(['Edit', 'Delete']);

        $this
            ->actingAs($secondUser)
            ->get('/articles/' . Article::first()->id)
            ->assertViewIs('articles.show')
            ->assertDontSee(['Edit', 'Delete']);
    }

    /** @test */
    public function test_an_amd_manager_can_edit_an_article_position(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);

        $this
            ->assertDatabaseCount('brands', 2)
            ->assertDatabaseCount('colors', 17)
            ->assertDatabaseCount('countries', 2)
            ->assertDatabaseCount('permissions', 4)
            ->assertDatabaseCount('roles', 2)
            ->assertDatabaseCount('seasons', 1)
            ->assertDatabaseCount('sizes', 13);

        $user->roles()->attach(Role::where('slug', 'amd-manager')->get());

        $newArticleData = [
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'Test Position',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ];

        $article = Article::create($newArticleData);

        $updatedArticleData = [
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => 'updatedconfig',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'UPDATED Test Position',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ];

        $this
            ->actingAs($user)
            ->patch('/articles/' . Article::first()->id, $updatedArticleData)
            ->assertStatus(302)
            ->assertRedirectToRoute('amd.show', $article);

        $this
            ->assertDatabaseCount('articles', 1)
            ->assertDatabaseHas('articles', [
                'buying_article_config' => 'updatedconfig',
                'supplier_article_name' => 'UPDATED Test Position'
            ]);
    }

    /** @test */
    public function test_an_amd_creator_can_delete_an_article_position(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $user = User::factory()->create();
        $this->seed(DatabaseSeeder::class);
        $user->roles()->attach(Role::where('slug', 'amd-manager')->get());

        $newArticleData = [
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'Test Position',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ];

        $article = Article::create($newArticleData);

        $this
            ->assertDatabaseCount('articles', 1)
            ->assertDatabaseHas('articles', [
                'buying_article_sku' => '111test222',
                'buying_article_config' => '111test222_c'
            ]);

        $this
            ->actingAs($user)
            ->get('/articles/' . Article::first()->id . '/delete')
            ->assertStatus(302)
            ->assertRedirectToRoute('amd.index');

        $this->assertSoftDeleted('articles', [
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c'
        ]);
    }
}
