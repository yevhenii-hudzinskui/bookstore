<?php

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
//    return UserResource::collection(User::take(3)->get()->keyBy->id);
//    return User::take(3)->get()->toResourceCollection();
    return User::paginate()->toResourceCollection();
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
