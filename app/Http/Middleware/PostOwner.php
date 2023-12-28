<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

       $ownerPost = Post::where("slug",$request->slug)->where("user_id",auth()->user()->id)->first();

       if(!$ownerPost){
           return redirect()->route('home');
       }

        return $next($request);
    }
}
