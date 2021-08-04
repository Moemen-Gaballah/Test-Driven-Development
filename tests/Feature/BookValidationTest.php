<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use App\Models\User;

class BookValidationTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotCreateBookWithEmptyTitle()
    {
        // self::markTestSkipped(); // ignore this test
        $response = $this->actingAs($this->user)->post('/books', $this->data(['title' => ""]));
        $response->assertSessionHasErrors(["title" => "title is required"]); 
    }

    public function testDescriptionIsRequired()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(['description' => ""]));
        $response->assertSessionHasErrors(["description" => "description is required"]); 
    }


    public function testDescriptionLengthMinimumIs20Charaters()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(['description' => "wadwa"]));
        $response->assertSessionHasErrors(["description" => "description length minimum is 20"]); 
    }


    public function testAuthorIdMustBeValid()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data());
        $response->assertSessionHasErrors(["author_id" => "Author must be valid"]); 
    }

    public function testIsbnMustBeOfValidFormat()
    {
        $response = $this->actingAs($this->user)->post('/books', $this->data(["ISBN" => "dawwadaw"]));
        $response->assertSessionHasErrors(["ISBN" => "ISBN must be of valid format"]); 
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    private function data($data = [])
    {
        $author = Author::factory()->create([
            'name' => 'onlyTest',
        ]);

        $default = [
            "title" => "Gone with the wind",
            "description" => "Bestseller or New York Times",
            "author_id" => $author->id,
            "author_id" => 1,
            "ISBN" => "12b-422-24ff"
        ];

        return array_merge($default, $data);
    }
}
