<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Services\AlertService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    function index(Request $request)
    {
        $blogs = Blog::where('status', 1)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {

                $slug = $request->category;

                $query->whereHas('blogCategory', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->get();
        return view('frontend.pages.blog', compact('blogs'));
    }

    function show(string $slug)
    {
        $blog = Blog::with('comments')->where('slug', $slug)->firstOrFail();

        $recent_blogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        $blog_categories = BlogCategory::withCount('blogs')->where('status', 1)->get();

        return view('frontend.pages.blog-detail', compact('blog', 'recent_blogs', 'blog_categories'));
    }

    function storeComment(Request $request, int $id)
    {
        $validated = $request->validate([
            'comment' => 'string|required|max:255'
        ]);

        $blog = Blog::find($id);

        BlogComment::create([
            'user_id' => user()->id,
            'blog_id' => $blog->id,
            'comment' => $validated['comment']
        ]);

        AlertService::created();
        return redirect()->back();
    }


}
