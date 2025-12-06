<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class SliderController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'banner' => ['required', 'image'],
                'btn_url' => ['nullable', 'url'],
                'serial' => ['required', 'integer'],
                'status' => ['required'],

                // translations
                'title' => ['required', 'array'],
                'title.*' => ['required', 'string'],
                'type' => ['required', 'array'],
                'type.*' => ['required', 'string'],
                'starting_price' => ['required', 'array'],
                'starting_price.*' => ['required', 'string'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $slider = new Slider();

        $slider->banner = $this->uploadImage($request, 'banner', 'uploads');
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        // ✅ Save slider first
        $slider->save();

        // ✅ Save translations
        foreach ($request->title as $locale => $title) {
            $slider->translations()->create([
                'locale' => $locale,
                'title' => $title,
                'type' => $request->type[$locale],
                'starting_price' => $request->starting_price[$locale]
            ]);
        }

        notify()->success('Banner Slider Information Uploaded Successfully!');


        return redirect()->route('admin.slider.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'banner' => ['nullable', 'image', 'max:2046'],

                'btn_url' => ['nullable', 'url'],
                'serial' => ['required', 'integer'],
                'status' => ['required'],

                // translations validation
                'title' => ['required', 'array'],
                'title.*' => ['required', 'string', 'max:255'],
                'type' => ['required', 'array'],
                'type.*' => ['required', 'string', 'max:100'],
                'starting_price' => ['required', 'array'],
                'starting_price.*' => ['required', 'string', 'max:255'],
            ]);
        } catch (ValidationException $e) {
            notify()->error('Please correct the form errors and try again.');
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $slider = Slider::findOrFail($id);
        $hasChanges = false;

        // Handle banner image
        $imagePath = $this->uploadImage($request, 'banner', 'uploads');

        if ($imagePath) {
            $slider->banner = $imagePath;
            $hasChanges = true;
        }

        // Update main slider fields
        if (
            $slider->btn_url !== $request->btn_url ||
            $slider->serial !== $request->serial ||
            $slider->status !== $request->status
        ) {
            $slider->btn_url = $request->btn_url;
            $slider->serial = $request->serial;
            $slider->status = $request->status;

            $hasChanges = true;
        }

        // Update translations
        foreach ($request->title as $locale => $title) {

            $translation = $slider->translations()->where('locale', $locale)->first();

            if ($translation) {

                if (
                    $translation->title !== $title ||
                    $translation->type !== $request->type[$locale] ||
                    $translation->starting_price !== $request->starting_price[$locale]
                ) {
                    $translation->update([
                        'title' => $title,
                        'type' => $request->type[$locale],
                        'starting_price' => $request->starting_price[$locale],
                    ]);

                    $hasChanges = true;
                }
            } else {
                $slider->translations()->create([
                    'locale' => $locale,
                    'title' => $title,
                    'type' => $request->type[$locale],
                    'starting_price' => $request->starting_price[$locale],
                ]);

                $hasChanges = true;
            }
        }


        if ($hasChanges) {
            $slider->save();
            notify()->success('Banner Slider Information Edited Successfully!');
            return redirect()->route('admin.slider.index');
        }

        notify()->info('No changes were made.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();

        notify()->success('Banner Slider Information Deleted Successfully!');

        return redirect()->back();
    }
}
