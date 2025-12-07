@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Category</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data"">
                                @csrf


                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button class="btn btn-primary" data-icon="" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" role="iconpicker" name="icon">
                                        </button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">— No Parent —</option>
                                        @foreach ($categories as $category)
                                            @include('admin.category.partials.option', [
                                                'category' => $category,
                                                'prefix' => '',
                                            ])
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Order</label>
                                    <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
