<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.dashboard.blog.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog_categories = BlogCategory::where('status', 1)->get();
        return view('admin.dashboard.blog.blog.create', compact('blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'description' => 'required',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                null,
                'blog_images'
            );
        }

        $validated['user_id'] = user('admin')->id;
        Blog::create($validated);

        AlertService::created();

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog_categories = BlogCategory::where('status', 1)->get();
        return view('admin.dashboard.blog.blog.edit', compact('blog', 'blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'description' => 'required',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $blog->image,
                'blog_images'
            );
        }

        $blog->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'blog_category_id' => $validated['blog_category_id'],
            'description' => $validated['description'],
            'image' => $validated['image'] ?? $blog->image,
            'status' => $validated['status'] ?? 0,
        ]);

        AlertService::updated();
        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $this->deleteFile($blog->image);
        $blog->delete();

        AlertService::deleted();
        return redirect()->route('admin.blogs.index');
    }

    function blogCommentIndex(Request $request)
    {
        $query = BlogComment::with(['user', 'blog']);

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter blog
        if ($request->filled('blog')) {
            $query->where('blog_id', $request->blog);
        }

        // Search comment
        if ($request->filled('search')) {
            $query->where('comment', 'like', '%' . $request->search . '%');
        }

        $blog_comments = $query->latest()->paginate(10)->withQueryString();

        $blogs = Blog::select('id', 'title')->get();

        return view('admin.dashboard.blog.blog-comment.index', compact(
            'blog_comments',
            'blogs'
        ));
    }

    public function blogCommentDestroy(BlogComment $blogComment)
    {
        $blogComment->delete();

        return redirect()
            ->back()
            ->with('success', 'Comment deleted successfully');
    }

    public function changeStatus(
        Request $request,
        BlogComment $blogComment
    ) {

        $request->validate([
            'status' => 'required'
        ]);

        $blogComment->status = $request->status == "1" ? 1 : 0;
        $blogComment->save();

        AlertService::updated();

        return redirect()->back();
    }
}
