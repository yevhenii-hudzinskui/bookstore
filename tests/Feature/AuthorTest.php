<?php

use App\Models\Author;
use App\Models\User;
use Database\Seeders\AuthorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->use(RefreshDatabase::class);

test('index', function () {

    $user = User::factory()->create();
    $this->seed(AuthorSeeder::class);
    $authors = Author::all();

    $response = $this->actingAs($user)
        ->get(route('authors.index'));

    $response->ddBody();
//    $response->assertSeeText('Authors is empty');
    $response->assertSeeInOrder($authors->pluck('name')->toArray());
//    $response->assertSeeText($author->name);
    $response->assertStatus(200);
});


test('create new author', function () {
    $user = User::factory()->create();
    $author = Author::factory()->make();

    $this->assertModelExists($user);

    $this->assertDatabaseEmpty('authors');

    $response = $this->actingAs($user)
        ->post(route('authors.index'), [
            'name' => \Illuminate\Support\Str::random(265),
            'country' => $author->country,
        ]);


    $response->assertInvalid([
        'name' => "The name field must not be greater than 255 characters.",
    ]);
//    $response->assertValid();
//    $response->assertValid(['name']);
//    $this->assertDatabaseCount('authors', 1);
//    $this->assertDatabaseHas('authors', [
//        'name' => $author->name,
//    ]);
//    $response->assertRedirectToRoute("authors.index");
});
