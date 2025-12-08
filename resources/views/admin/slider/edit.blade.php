@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Slider</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Slider</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- ===========================
                                Base Slider Fields
                            ============================ --}}
                                <h5 class="mb-3">Base Information</h5>

                                <div class="">
                                    <label>Current Banner</label><br>
                                    <img src="{{ asset($slider->banner) }}" alt="" width="150" class="mb-2">
                                </div>
                                <div class="row">


                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Change Banner (optional)</label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>

                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Button URL</label>
                                        <input type="text" class="form-control" name="btn_url"
                                            value="{{ old('btn_url', $slider->btn_url) }}">
                                    </div>

                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Serial</label>
                                        <input type="number" class="form-control" name="serial"
                                            value="{{ old('serial', $slider->serial) }}">
                                    </div>

                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                {{-- ===========================
                                Translation Tabs
                            ============================ --}}
                                <h5 class="mb-3 mt-3">Translations</h5>

                                <ul class="nav nav-tabs" id="translationTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="uz-tab" data-toggle="tab" href="#uz"
                                            role="tab">UZ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ru-tab" data-toggle="tab" href="#ru"
                                            role="tab">RU</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en"
                                            role="tab">EN</a>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3">

                                    {{-- ===========================
                                    Uzbek
                                ============================ --}}
                                    <div class="tab-pane fade show active" id="uz" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Title (UZ)</label>
                                                    <input type="text" class="form-control" name="title[uz]"
                                                        value="{{ old('title.uz', $slider->translate('uz')->title ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <input type="text" class="form-control" name="type[uz]"
                                                        value="{{ old('type.uz', $slider->translate('uz')->type ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Starting Price (UZ)</label>
                                                    <input type="text" class="form-control" name="starting_price[uz]"
                                                        value="{{ old('starting_price.uz', $slider->translate('uz')->starting_price ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ===========================
                                        Russian
                                    ============================ --}}
                                    <div class="tab-pane fade" id="ru" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Title (RU)</label>
                                                    <input type="text" class="form-control" name="title[ru]"
                                                        value="{{ old('title.ru', $slider->translate('ru')->title ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <input type="text" class="form-control" name="type[ru]"
                                                        value="{{ old('type.ru', $slider->translate('ru')->type ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Starting Price (RU)</label>
                                                    <input type="text" class="form-control" name="starting_price[ru]"
                                                        value="{{ old('starting_price.ru', $slider->translate('ru')->starting_price ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ===========================
                                        English
                                    ============================ --}}
                                    <div class="tab-pane fade" id="en" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Title (EN)</label>
                                                    <input type="text" class="form-control" name="title[en]"
                                                        value="{{ old('title.en', $slider->translate('en')->title ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Type</label>
                                                    <input type="text" class="form-control" name="type[en]"
                                                        value="{{ old('type.en', $slider->translate('en')->type ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label>Starting Price (EN)</label>
                                                    <input type="text" class="form-control" name="starting_price[en]"
                                                        value="{{ old('starting_price.en', $slider->translate('en')->starting_price ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                {{-- ===========================
                                    Submit Button
                                ============================ --}}
                                <button type="submit" class="btn btn-primary mt-3">
                                    Update Slider
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
