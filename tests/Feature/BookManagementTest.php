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


    public function setUp()
    {
        parent::setUp();
    }

    public function testStatus201WithMessageCreatedWhenCreateABook()
    {
        $this->withoutExceptionHandling();

        $response = $this->post("/books", [
            "title" => "Gone with the wind",
            "description" => "Bestseller or New York Times",
            "author_id" => 1,
            "ISBN" => "12b-422-24ff"
        ]);

        $response->assertCreated();
        $response->assertJson(["message" => "Created"]);
    }

    public function testCountOfDatabaseInBooksTableIs1()
    {
        $this->post("/books", [
            "title" => "Gone with the wind",
            "description" => "Bestseller or New York Times",
            "author_id" => 1,
            "ISBN" => "12b-422-24ff"
        ]);

        $this->assertDatabaseCount('books', 1);
    }

}
