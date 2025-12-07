@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">

                                @csrf
                                @method('PUT')


                                {{-- ===========================
                                    Base Fields
                                ============================ --}}
                                <h5 class="mb-3">Base Information</h5>

                                <div class="row">

                                    {{-- Icon --}}

                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Icon</label>
                                        <div>
                                            <button class="btn btn-primary" data-icon="{{ $category->icon }}"
                                                data-selected-class="btn-danger" data-unselected-class="btn-info"
                                                role="iconpicker" name="icon">
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Parent --}}
                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Parent Category</label>

                                        <select class="form-control" name="parent_id">

                                            <option value="">— No Parent —</option>

                                            @foreach ($categories as $cat)
                                                @include('admin.category.partials.option', [
                                                    'category' => $cat,
                                                    'prefix' => '',
                                                    'selected' => $category->parent_id,
                                                ])
                                            @endforeach

                                        </select>
                                    </div>

                                    {{-- Status --}}
                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Status</label>

                                        <select class="form-control" name="status">
                                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Order --}}
                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Order</label>

                                        <input type="number" class="form-control" name="order"
                                            value="{{ old('order', $category->order) }}">
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
                                    <div class="tab-pane fade show active" id="uz">

                                        <div class="form-group">
                                            <label>Name (UZ)</label>

                                            <input type="text" class="form-control" name="name[uz]"
                                                value="{{ old('name.uz', optional($category->translate('uz'))->name) }}">
                                        </div>

                                    </div>


                                    {{-- ===========================
                                        Russian
                                    ============================ --}}
                                    <div class="tab-pane fade" id="ru">

                                        <div class="form-group">
                                            <label>Name (RU)</label>

                                            <input type="text" class="form-control" name="name[ru]"
                                                value="{{ old('name.ru', optional($category->translate('ru'))->name) }}">
                                        </div>

                                    </div>


                                    {{-- ===========================
                                        English
                                    ============================ --}}
                                    <div class="tab-pane fade" id="en">

                                        <div class="form-group">
                                            <label>Name (EN)</label>

                                            <input type="text" class="form-control" name="name[en]"
                                                value="{{ old('name.en', optional($category->translate('en'))->name) }}">
                                        </div>

                                    </div>

                                </div> {{-- tab-content --}}


                                <button type="submit" class="btn btn-primary mt-4">
                                    Update Category
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
