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
                            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{ asset($product->thumb_image) }}" style="width:200px" alt="">
                                </div>

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
                                                <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active
                                                </option>
                                                <option {{ $product->status == 0 ? 'selected' : '' }} value="0">
                                                    Inactive
                                                </option>
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
                                            <input type="text" class="form-control" name="price"
                                                value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Offer Price</label>
                                            <input type="text" class="form-control" name="offer_price"
                                                value="{{ $product->offer_price }}">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Stock Quantity</label>
                                            <input type="number" min="0" class="form-control" name="qty"
                                                value="{{ $product->qty }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date"
                                                value="{{ $product->offer_start_date }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date"
                                                value="{{ $product->offer_end_date }}">
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

                                {{-- ===========================
                                    Translation Tabs
                                ============================ --}}
                                <hr>

                                <h5 class="mt-3 mb-3">Translations</h5>

                                <ul class="nav nav-tabs" id="translationTabs">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#uz">UZ</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#ru">RU</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#en">EN</a>
                                    </li>

                                </ul>

                                <div class="tab-content mt-3">

                                    {{-- ===========================
                                        Uzbek
                                    ============================ --}}
                                    <div class="tab-pane fade show active" id="uz" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Name (UZ)</label>
                                                    <input type="text" class="form-control" name="name[uz]"
                                                        value="{{ old('name.uz', $product->translate('uz')->name ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Short Description</label>
                                                    <textarea name="short_description[uz]" class="form-control">{!! $product->translate('uz')->short_description ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Long Description (UZ)</label>
                                                    <textarea name="long_description[uz]" class="form-control">{!! $product->translate('uz')->long_description ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ===========================
                                        Russian
                                    ============================ --}}
                                    <div class="tab-pane fade" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Name (Ru)</label>
                                                    <input type="text" class="form-control" name="name[ru]"
                                                        value="{{ old('name.ru', $product->translate('ru')->name ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Short Description</label>
                                                    <textarea name="short_description[ru]" class="form-control">{!! $product->translate('ru')->short_description ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Long Description (ru)</label>

                                                    <textarea name="long_description[ru]" class="form-control summernote">{!! $product->translate('ru')->long_description ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ===========================
                                        English
                                    ============================ --}}
                                    <div class="tab-pane fade" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Name (En)</label>
                                                    <input type="text" class="form-control" name="name[en]"
                                                        value="{{ old('name.en', $product->translate('en')->name ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Short Description</label>
                                                    <textarea name="short_description[en]" class="form-control">{!! $product->translate('en')->short_description ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Long Description (en)</label>

                                                    <textarea name="long_description[en]" class="form-control summernote">
                                                         {!! $product->translate('en')->long_description ?? '' !!}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div> {{-- tab-content --}}

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
