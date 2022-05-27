<?php

namespace App\Traits;

use App\Post;

trait searchFilters {
    function composeQuery($request) {
        $postsQuery = Post::whereRaw('1 = 1');

        if ($request->s) {
            $postsQuery->where(function($query) use ($request) { // per aggiungere le parentesi nell'SQL
                $query->where('title', 'LIKE', "%$request->s%")
                    ->orWhere('content', 'LIKE', "%$request->s%");
            });
        }

        if ($request->category) {
            $postsQuery->where('category_id', $request->category);
        }

        if ($request->author) {
            $postsQuery->where('user_id', $request->author);
        }

        if ($request->tags) {
            $tags = $request->tags;
            foreach ($tags as $tag) {
                $postsQuery->whereHas('tags', function($query) use ($tag) {
                    $query->where('name', $tag);
                });
            }
        }

        return $postsQuery;
    }
}
