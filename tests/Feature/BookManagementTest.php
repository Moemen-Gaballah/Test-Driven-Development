<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookManagementTest extends TestCase
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


    public function testStatus201WithMessageCreatedWhenCreateABook()
    {
        // $this->withoutExceptionHandling();

        $this->response->assertCreated();
        $this->response->assertJson(["message" => "Created"]);
    }

    public function testCountOfDatabaseInBooksTableIs1()
    {
        
        $this->assertDatabaseCount('books', 1);
    }


    public function testCannotCreateBookWithEmptyTitle()
    {
        // self::markTestSkipped(); // ignore this test
        $response = $this->post('/books', $this->data(['title' => ""]));
        $response->assertSessionHasErrors(["title" => "title is required"]); 
    }

    private function data($data = [])
    {
        $default = [
            "title" => "Gone with the wind",
            "description" => "Bestseller or New York Times",
            "author_id" => 1,
            "ISBN" => "12b-422-24ff"
        ];

        return array_merge($default, $data);
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->response = $this->post("/books", $this->data());
    }


}
