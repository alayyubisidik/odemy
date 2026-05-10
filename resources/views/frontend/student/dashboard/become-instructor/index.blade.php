@extends('frontend.student.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Become Instructor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('student.become-instructor.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <div class="mb-3">
                                <label class="form-label">Document</label>
                                <input type="file" name="document" class="form-control" />
                                <x-input-error :messages="$errors->get('document')" class="mt-2" />
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
