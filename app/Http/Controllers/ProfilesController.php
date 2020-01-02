<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {

        $postsCount = Cache::remember(
            'posts.count.' . $user->id,
            now()->addSeconds(30),
            function () use ($user){
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'followers.count.' . $user->id,
            now()->addSeconds(30),
            function () use ($user){
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'following.count.' . $user->id,
            now()->addSeconds(30),
            function () use ($user){
                return $user->following->count();
            });

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => '',
            'description' => '',
            'url' => '',
            'image' => '',
        ]);


        if (request('image')){

            $imagePath = request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);

            $image->save();

            auth()->user()->profile->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));

        }
        else
        {
            auth()->user()->profile->update($data);
        }



        return redirect("/profile/{$user->id}");

    }
}
