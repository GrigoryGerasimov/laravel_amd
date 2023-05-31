<?php

namespace Tests\Feature\Api;

use App\Models\{Brand, Color, Country, Season, Size, User, Article};
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\{WithFaker, RefreshDatabase};
use Illuminate\Foundation\Testing\Concerns\InteractsWithExceptionHandling;
use Tests\TestCase;

final class ArticleApiTest extends TestCase
{
    use InteractsWithExceptionHandling, WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeader('accept', 'application/json');
    }

    /** @test */
    public function test_a_registered_user_can_pass_jwt_auth(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'james.su.test@test.com',
            'password' => 'Password@12345'
        ];

        $user = User::create(['name' => 'James Sutherland', ...$credentials]);

        $response = $this->post('/api/auth/login', $credentials);
        $response
            ->assertJson([
                'token_type' => 'bearer',
                'expires_in' => 3600
            ])
            ->assertSuccessful()
            ->assertStatus(200);
    }

    /** @test */
    public function test_a_registered_user_cannot_pass_jwt_auth_with_invalid_data(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $firstUser = User::create([
            'name' => 'Tiffany Doe',
            'email' => 'tiff.doe.test@test.com',
            'password' => 'Password@567890'
        ]);
        $secondUser = User::create([
            'name' => 'Jane Winneyfried Doe',
            'email' => 'jane.doe.test@test.com',
            'password' => 'Password@12345'
        ]);

        $firstResponse = $this->post('/api/auth/login', [
            'email' => 'tiff.doe.test@test.com',
            'password' => '12345'
        ]);
        $secondResponse = $this->post('/api/auth/login', [
            'email' => 'testmail@teeest.test',
            'password' => 'Password@12345'
        ]);

        $firstResponse
            ->assertStatus(401)
            ->assertUnauthorized();
        $secondResponse
            ->assertStatus(401)
            ->assertUnauthorized();
    }

    /** @test */
    public function test_only_jwt_authenticated_user_can_access_api_amd_index(): void
    {
        $firstUser = User::factory()->create();

        $this
            ->actingAs($firstUser)
            ->get('/api/articles')
            ->assertStatus(401)
            ->assertUnauthorized();

        $credentials = [
            'email' => 'testmail@test.com',
            'password' => 'Password@12345'
        ];

        $secondUser = User::create([
            'name' => 'Test User',
            ...$credentials
        ]);

        $this
            ->assertDatabaseCount('users', 2)
            ->assertDatabaseHas('users', ['name' => 'Test User']);

        $token = auth('api')->attempt($credentials);

        $this
            ->actingAs($secondUser)
            ->withHeader('Authorization', "Bearer $token")
            ->get('/api/articles')
            ->assertStatus(200)
            ->assertOk();
    }

    /** @test */
    public function test_a_jwt_authenticated_user_receives_an_amd_api_index_resource(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'dummy.user@test.com',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Dummy User',
            ...$credentials
        ]);

        $dummyToken = auth('api')->attempt($credentials);

        $this->seed(DatabaseSeeder::class);

        $firstArticle = Article::create([
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'Test Position 1',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ]);

        $secondArticle = Article::create([
            'season_id' => Season::first()->id,
            'buying_article_sku' => '222test333',
            'buying_article_config' => '222test333_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '2222',
            'supplier_article_number' => '33333',
            'supplier_article_name' => 'Test Position 2',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'efgh12345hgfe',
            'country_id' => Country::first()->id,
            'hs_code' => '12345',
            'user_id' => User::first()->id
        ]);

        $this
            ->actingAs($user)
            ->withHeader('Authorization', "Bearer $dummyToken")
            ->get('/api/articles')
            ->assertJson([
                'data' => [
                    [
                        'season' => trim($firstArticle->season->name),
                        'buyingArticleSku' => trim($firstArticle->buying_article_sku),
                        'buyingArticleConfig' => trim($firstArticle->buying_article_config),
                        'brand' => trim($firstArticle->brand->name),
                        'supplierArticleForm' => trim($firstArticle->supplier_article_form),
                        'supplierArticleNumber' => trim($firstArticle->supplier_article_number),
                        'supplierArticleName' => trim($firstArticle->supplier_article_name),
                        'color' => trim($firstArticle->color->name),
                        'size' => trim($firstArticle->size->code),
                        'eanGtin' => trim($firstArticle->ean_gtin),
                        'countryOfOrigin' => trim($firstArticle->country->name),
                        'hsCode' => trim($firstArticle->hs_code),
                        'lastChangeBy' => trim($firstArticle->user->name),
                        'createdAt' => $firstArticle->created_at->format('Y-m-d'),
                        'updatedAt' => $firstArticle->updated_at->format('Y-m-d')
                    ],
                    [
                        'season' => trim($secondArticle->season->name),
                        'buyingArticleSku' => trim($secondArticle->buying_article_sku),
                        'buyingArticleConfig' => trim($secondArticle->buying_article_config),
                        'brand' => trim($secondArticle->brand->name),
                        'supplierArticleForm' => trim($secondArticle->supplier_article_form),
                        'supplierArticleNumber' => trim($secondArticle->supplier_article_number),
                        'supplierArticleName' => trim($secondArticle->supplier_article_name),
                        'color' => trim($secondArticle->color->name),
                        'size' => trim($secondArticle->size->code),
                        'eanGtin' => trim($secondArticle->ean_gtin),
                        'countryOfOrigin' => trim($secondArticle->country->name),
                        'hsCode' => trim($secondArticle->hs_code),
                        'lastChangeBy' => trim($secondArticle->user->name),
                        'createdAt' => $secondArticle->created_at->format('Y-m-d'),
                        'updatedAt' => $secondArticle->updated_at->format('Y-m-d')
                    ]
                ]
            ]);
    }

    /** @test */
    public function test_a_jwt_authenticated_user_receives_an_amd_api_article_resource(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $credentials = [
            'email' => 'dummy.user@test.com',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Dummy User',
            ...$credentials
        ]);

        $dummyToken = auth('api')->attempt($credentials);

        $this->seed(DatabaseSeeder::class);

        $firstArticle = Article::create([
            'season_id' => Season::first()->id,
            'buying_article_sku' => '111test222',
            'buying_article_config' => '111test222_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '1111',
            'supplier_article_number' => '22222',
            'supplier_article_name' => 'Test Position 1',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'abcd12345dcba',
            'country_id' => Country::first()->id,
            'hs_code' => '567890',
            'user_id' => User::first()->id
        ]);

        $secondArticle = Article::create([
            'season_id' => Season::first()->id,
            'buying_article_sku' => '222test333',
            'buying_article_config' => '222test333_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '2222',
            'supplier_article_number' => '33333',
            'supplier_article_name' => 'Test Position 2',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'efgh12345hgfe',
            'country_id' => Country::first()->id,
            'hs_code' => '12345',
            'user_id' => User::first()->id
        ]);

        $this
            ->assertDatabaseCount('articles', 2);

        $this
            ->actingAs($user)
            ->withHeader('Authorization', "Bearer $dummyToken")
            ->get('/api/articles/' . Article::first()->id)
            ->assertStatus(200)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'season' => trim($firstArticle->season->name),
                    'buyingArticleSku' => trim($firstArticle->buying_article_sku),
                    'buyingArticleConfig' => trim($firstArticle->buying_article_config),
                    'brand' => trim($firstArticle->brand->name),
                    'supplierArticleForm' => trim($firstArticle->supplier_article_form),
                    'supplierArticleNumber' => trim($firstArticle->supplier_article_number),
                    'supplierArticleName' => trim($firstArticle->supplier_article_name),
                    'color' => trim($firstArticle->color->name),
                    'size' => trim($firstArticle->size->code),
                    'eanGtin' => trim($firstArticle->ean_gtin),
                    'countryOfOrigin' => trim($firstArticle->country->name),
                    'hsCode' => trim($firstArticle->hs_code),
                    'lastChangeBy' => trim($firstArticle->user->name),
                    'createdAt' => $firstArticle->created_at->format('Y-m-d'),
                    'updatedAt' => $firstArticle->updated_at->format('Y-m-d')
                ]
            ]);
    }

    /** @test */
    public function test_a_jwt_authenticated_user_can_create_an_amd_api_article_resource(): void
    {
        $this
            ->withoutExceptionHandling()
            ->withoutDeprecationHandling();

        $this->seed(DatabaseSeeder::class);

        $credentials = [
            'email' => 'dummy.user@test.com',
            'password' => 'Password@12345'
        ];

        $user = User::create([
            'name' => 'Dummy User',
            ...$credentials
        ]);

        $token = auth('api')->attempt($credentials);

        $articleData = [
            'season_id' => Season::first()->id,
            'buying_article_sku' => '222test333',
            'buying_article_config' => '222test333_c',
            'brand_id' => Brand::first()->id,
            'supplier_article_form' => '2222',
            'supplier_article_number' => '33333',
            'supplier_article_name' => 'Test Position 2',
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id,
            'ean_gtin' => 'efgh12345hgfe',
            'country_id' => Country::first()->id,
            'hs_code' => '12345',
            'user_id' => User::first()->id
        ];

        $this
            ->actingAs($user)
            ->withHeader('Authorization', "Bearer $token")
            ->post('/api/articles', $articleData)
            ->assertStatus(201)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'season',
                    'buyingArticleSku',
                    'buyingArticleConfig',
                    'brand',
                    'supplierArticleForm',
                    'supplierArticleNumber',
                    'supplierArticleName',
                    'color',
                    'size',
                    'eanGtin',
                    'countryOfOrigin',
                    'hsCode',
                    'lastChangeBy',
                    'createdAt',
                    'updatedAt'
                ]
            ]);
    }
}
