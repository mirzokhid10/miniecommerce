@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Variant Item</h4>

                        </div>
                        <div class="card-body">
                            <form
                                action="{{ route('admin.products-variant-item.update', [
                                    'product' => $product->id,
                                    'variant' => $variant->id,
                                    'item' => $item->id,
                                ]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="product_variant_id" value="{{ $variant->id }}">

                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name"
                                        value="{{ $item->variant->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" name="price" value="{{ $item->price }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="">Select</option>
                                        <option {{ $item->is_default == 1 ? 'selected' : '' }} value="1">
                                            Yes
                                        </option>
                                        <option {{ $item->is_default == 0 ? 'selected' : '' }} value="0">
                                            No
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $item->status == 1 ? 'selected' : '' }} value="1">
                                            Active
                                        </option>
                                        <option {{ $item->status == 0 ? 'selected' : '' }} value="0">
                                            Inactive
                                        </option>
                                    </select>
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
                                                        value="{{ old('name.uz', $item->translate('uz')->name ?? '') }}">
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
                                                        value="{{ old('name.ru', $item->translate('ru')->name ?? '') }}">
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
                                                        value="{{ old('name.en', $item->translate('en')->name ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div> {{-- tab-content --}}

                                <button type="submmit" class="btn btn-primary">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
