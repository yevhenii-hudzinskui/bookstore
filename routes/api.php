<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    sleep(25);
    return User::paginate()->toResourceCollection();
});

Route::post('/users', function (Request $request) {
    User::create($request->all());
//    return response()->json(['message' => 'User created successfully']);
    return response(null, 201);
});

Route::get('/user/{id}', function (string $id) {
//    return new UserResource(User::findOrFail($id));
    $user =User::with('books')
        ->withCount('books')
//        ->select(['id', 'email', 'name', 'created_at', 'updated_at'])
        ->findOrFail($id);
//        dd($user);
        return $user->toResource();
});
