<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Services\SliderService;
use App\DataTables\SliderDataTable;

class SliderController extends Controller
{
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(StoreSliderRequest $request, SliderService $service)
    {
        $service->create($request->validated());

        notify()->success('Slider created successfully!');

        return redirect()->route('admin.slider.index');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider, SliderService $service)
    {
        $service->update($slider, $request->validated());

        notify()->success('Slider updated successfully!');

        return redirect()->route('admin.slider.index');
    }

    public function destroy(Slider $slider, SliderService $service)
    {
        $service->delete($slider);

        notify()->success('Slider deleted successfully!');

        return redirect()->back();
    }
}
