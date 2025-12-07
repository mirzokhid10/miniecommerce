<option value="{{ $category->id }}">
    {{ $prefix }}{{ $category->translations->first()->name ?? $category->name }}
</option>

@if ($category->children && $category->children->count())
    @foreach ($category->children as $child)
        @include('admin.category.partials.option', [
            'category' => $child,
            'prefix' => $prefix . '— ',
        ])
    @endforeach
@endif
