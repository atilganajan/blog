<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    use FileTrait;

    public function home()
    {
        try {
            $categories = Category::with("posts")->get();
            $posts = Post::with("category")->latest()->paginate(8);
            return view("pages.home")->with(["posts" => $posts, "categories" => $categories]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }

    }

    public function getPostsByCategory($categoryName)
    {
        try {
            $categories = Category::with("posts")->get();

            $selectedCategory = Category::where('name', $categoryName)->firstOrFail();
            $posts = $selectedCategory->posts()->latest()->paginate(8);

            return view("pages.home")->with(["posts" => $posts, "categories" => $categories]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }
    }


    public function create()
    {
        try {
            return view("pages.create")->with(["categories" => Category::select("name")->get()]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }
    }

    public function store(CreatePostRequest $request)
    {
        try {
            $data = $request->only(["title", "image", "content", "category"]);
            $category = Category::findByName($data["category"]);
            $image = $this->createPostImage($data["image"]);

            Post::create([
                "title" => $data["title"],
                "image" => $image,
                "content" => $data["content"],
                "category_id" => $category->id,
                "user_id" => auth()->user()->id,
            ]);

            return redirect()->route("home")->with("success", "Post created successfully");
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }
    }

    public function show($slug)
    {
        try {
            $post = Post::findBySlug($slug);

            if (!$post) {
                return redirect()->route("home")->with(["error" => "Post Not Found"]);
            }

            return view("pages.show")->with(["post" => $post]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }
    }

    public function edit($slug)
    {

        try {
            $post = Post::findBySlug($slug);
            $categories = Category::get();

            if (!$post) {
                return redirect()->route("home")->with(["error" => "Post Not Found"]);
            }

            return view("pages.edit")->with(["post" => $post, "categories" => $categories]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }

    }

    public function update(UpdatePostRequest $request)
    {

        try {
            $data = $request->only(["title", "image", "content", "category", "slug", "change_image"]);
            $post = Post::findBySlug($data["slug"]);
            $category = Category::findByName($data["category"]);

            if (!$post) {
                return redirect()->route("home")->with(["error" => "Post Not Found"]);
            }

            if (isset($data["change_image"]) && $data["change_image"] === "on") {
                $data["image"] = $this->updatePostImage($data["image"], $post->image);
            }

            $post->update([
                "title" => $data["title"],
                "image" => $data["image"] ?? $post->image,
                "content" => $data["content"],
                "category_id" => $category->id
            ]);

            return redirect()->route("home")->with("success", "Post updated successfully");

        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }
    }


    public function delete(Request $request)
    {
        try {
            $post = Post::findBySlug($request->only("slug"));

            if (!$post) {
                return redirect()->route("home")->with(["error" => "Post Not Found"]);
            }

            if (file_exists($post->image)) {
                File::delete($post->image);
            }
            $post->delete();

            return redirect()->route("home")->with(["success" => "Post deleted successfully"]);
        } catch (\Exception $err) {
            Log::error("File: " . $err->getFile() . " Line: " . $err->getLine() . " Error: " . $err->getMessage());
            return response()->view("error.500", [], 500);
        }
    }


}
