@extends('admin.dashboard.layouts.app')

@section('content')
    <div class="container-xl">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Blog Comment Management</h3>
            </div>

            {{-- FILTER --}}
            <div class="card-body border-bottom">

                <form method="GET">

                    <div class="row g-2">

                        {{-- SEARCH --}}
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search comment..."
                                value="{{ request('search') }}">
                        </div>

                        {{-- FILTER STATUS --}}
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>

                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        {{-- FILTER BLOG --}}
                        <div class="col-md-3">
                            <select name="blog" class="form-select">

                                <option value="">All Blog</option>

                                @foreach ($blogs as $blog)
                                    <option value="{{ $blog->id }}"
                                        {{ request('blog') == $blog->id ? 'selected' : '' }}>
                                        {{ $blog->title }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- BUTTON --}}
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">
                                Filter
                            </button>
                        </div>

                    </div>

                </form>

            </div>

            {{-- TABLE --}}
            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-vcenter card-table">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
                                <th>Blog</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th width="80">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($blog_comments as $comment)
                                <tr>

                                    <td>
                                        {{ $blog_comments->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        {{ $comment->user->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $comment->blog->title ?? '-' }}
                                    </td>

                                    <td style="max-width: 300px">
                                        {{ Str::limit($comment->comment, 80) }}
                                    </td>

                                    <td>

                                        <form action="{{ route('admin.blogs-comment.change-status', $comment) }}"
                                            method="POST">

                                            @csrf
                                            @method('put')

                                            <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()">

                                                <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0" {{ $comment->status == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>

                                            </select>

                                        </form>

                                    </td>

                                    <td>
                                        {{ $comment->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.blogs-comment.destroy', $comment) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this comment?')">
                                                    <i class="ti ti-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">
                                        No Data Available
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- PAGINATION --}}
            <div class="card-footer">

                {{ $blog_comments->links() }}

            </div>

        </div>

    </div>
@endsection
