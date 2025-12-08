@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>
        <div class="section-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" class="form-control" name="thumb_image">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Status</label>
                                            <select id="inputState" class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>SKU</label>
                                            <input type="text" class="form-control" name="sku" placeholder="usz">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control main-category" name="category"
                                                data-selected="{{ old('category', $product->category_id ?? '') }}">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <select class="form-control sub-category" name="sub_category" disabled
                                                data-selected="{{ old('sub_category', $product->sub_category_id ?? '') }}">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Child Category</label>
                                            <select class="form-control child-category" name="child_category" disabled
                                                data-selected="{{ old('child_category', $product->child_category_id ?? '') }}">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Offer Price</label>
                                            <input type="text" class="form-control" name="offer_price">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Stock Quantity</label>
                                            <input type="number" min="0" class="form-control" name="qty">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Product Type</label>
                                            <select id="inputState" class="form-control" name="product_type">
                                                <option value="">Select</option>
                                                <option value="new_arrival">New Arrival</option>
                                                <option value="featured_product">Featured</option>
                                                <option value="top_product">Top Product</option>
                                                <option value="best_product">Best Product</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submmit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // When main category changes
            $('.main-category').on('change', function() {
                let categoryId = $(this).val();
                let subSelect = $('.sub-category');
                let childSelect = $('.child-category');

                // Reset sub and child categories
                subSelect.prop('disabled', true).html('<option value="">Select</option>');
                childSelect.prop('disabled', true).html('<option value="">Select</option>');

                if (categoryId) {
                    $.ajax({
                        url: '/admin/categories/' + categoryId + '/children',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log('Category children:', data); // Debug log

                            if (data && data.length > 0) {
                                subSelect.prop('disabled', false);
                                data.forEach(function(item) {
                                    subSelect.append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                });
                            } else {
                                console.log('No sub-categories found');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading sub-categories:', error);
                        }
                    });
                }
            });

            // When sub category changes
            $('.sub-category').on('change', function() {
                let subId = $(this).val();
                let childSelect = $('.child-category');

                // Reset child category
                childSelect.prop('disabled', true).html('<option value="">Select</option>');

                if (subId) {
                    $.ajax({
                        url: '/admin/categories/' + subId + '/children',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log('Sub-category children:', data); // Debug log

                            if (data && data.length > 0) {
                                childSelect.prop('disabled', false);
                                data.forEach(function(item) {
                                    childSelect.append(
                                        `<option value="${item.id}">${item.name}</option>`
                                    );
                                });
                            } else {
                                console.log('No child-categories found');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading child-categories:', error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
