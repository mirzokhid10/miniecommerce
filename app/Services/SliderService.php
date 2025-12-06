<?php

namespace App\Services;

use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request as HttpRequest;

class SliderService
{
    use ImageUploadTrait;

    /**
     * Create a slider with banner upload + translations.
     */
    public function create(array $data): Slider
    {
        // Handle banner upload (same behavior as controller)
        $bannerPath = null;

        if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
            // create a real Illuminate Request and attach the UploadedFile
            $fakeRequest = new HttpRequest();
            $fakeRequest->files->set('banner', $data['banner']);

            $bannerPath = $this->uploadImage(
                $fakeRequest,
                'banner',
                'uploads'
            );
        }

        $slider = Slider::create([
            'banner'  => $bannerPath,
            'btn_url' => $data['btn_url'] ?? null,
            'serial'  => $data['serial'],
            'status'  => $data['status'],
        ]);

        $this->syncTranslations($slider, $data);

        return $slider;
    }

    public function update(Slider $slider, array $data): Slider
    {
        // Update main fields
        $slider->update([
            'btn_url' => $data['btn_url'] ?? null,
            'serial'  => $data['serial'],
            'status'  => $data['status'],
        ]);

        // Upload new banner if provided
        if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {

            // delete old image
            $this->deleteImage($slider->banner);

            // attach file to real Request and call trait
            $fakeRequest = new HttpRequest();
            $fakeRequest->files->set('banner', $data['banner']);

            $slider->banner = $this->uploadImage(
                $fakeRequest,
                'banner',
                'uploads'
            );

            $slider->save();
        }

        // Sync translations
        $this->syncTranslations($slider, $data);

        return $slider;
    }

    /**
     * Delete slider + delete image from storage.
     */
    public function delete(Slider $slider): void
    {
        $this->deleteImage($slider->banner);
        $slider->delete();
    }

    /**
     * Create or update translations for a slider.
     */
    private function syncTranslations(Slider $slider, array $data): void
    {
        foreach ($data['title'] as $locale => $title) {
            $slider->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title'          => $title,
                    'type'           => $data['type'][$locale],
                    'starting_price' => $data['starting_price'][$locale],
                ]
            );
        }
    }
}
