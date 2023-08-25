<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function Store(StoreLikeRequest $request){
        $validatedData = $request->validated();

        if ( Like::query()
                ->wherePostId($validatedData['post_id'])
                ->whereEmail($validatedData['email'])
                ->exists() 
            ) {
          
            return response()->json([
                'success' => 'false',
                'message' => 'You have already liked this post',
            ]);

        }else{

            Like::create($validatedData);
            return response()->json([
                'success' => 'true',
                'message' => 'You have liked this post',
                'likes' => Like::wherePostId($validatedData['post_id'])->count()
            ]);

        }

    }
}
