<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use App\Models\User;

class BookCURDTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    public function testStatus201WithMessageCreatedWhenCreateABookWhenAuthenticated()
    {
        // $this->withoutExceptionHandling();

        // $user = User::factory()->create();
        $response = $this->actingAs($this->user)->post('/books', $this->data());

        $response->assertCreated();
        $response->assertJson(["message" => "Created"]);
    }

    public function testRedirectToLoginIfNotAuthenticatedWith302Status()
    {
        $response = $this->post('/books', $this->data());
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testCountOfDatabaseInBooksTableIs1()
    {
        // $user = User::factory()->create();
        $this->actingAs($this->user)->post("/books", $this->data());
        $this->assertDatabaseCount('books', 1);
    }
    

    public function testAssertValidatedCookieExistsAfterVisitingBooksRoute()
    {
        // $user = User::factory()->create();
        $response = $this->actingAs($this->user)->post("/books", $this->data());
        $response->assertCookie('validated', 'yes');
    }

    public function testLibrarianCanSeeBookCreatingForm()
    {
       $user = $this->user;
       $user->role = "Librarian";
       $res = $this->actingAs($user)->get('/books/create');
       $res->assertOk(); 
       $res->assertViewIs("books.book_creation");
    }

    public function testNonLibrarianCannotSeeBookCreatingForm()
    {
        // $this->withoutExceptionHandling();

        $user = $this->user;
        $user->role = "non-librarian";
        $res = $this->actingAs($user)->get('/books/create');
        $res->assertForbidden(); 

    }


    private function data($data = [])
    {
        $author = Author::factory()->create([
            'name' => 'test',
        ]);

        $default = [
            "title" => "Gone with the wind",
            "description" => "Bestseller or New York Times",
            "author_id" => $author->id,
            // "author_id" => 1,
            "ISBN" => "12b-422-24ff"
        ];

        return array_merge($default, $data);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


}
