@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>
        <div class="mb-3">
            <a href="{{ route('admin.products-variant.index', ['product' => $product->id]) }}"
                class="btn btn-primary">Back</a>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Variant: {{ $variant->name }} </h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.products-variant-item.index', ['product' => $product->id, 'variant' => $variant->id]) }}"
                                    class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

<script>
    document.addEventListener('click', function(e) {
        if (!e.target.classList.contains('change-status')) return;

        let isChecked = e.target.checked;
        let id = e.target.dataset.id;

        $.ajax([
            'url' => route('admin.products-variant-item.index', [
                'product' => $this - > product - > id,
                'variant' => $this - > variant - > id,
            ])
        ])
        method: 'PUT',
            data: {
                status: isChecked,
                id: id
            },
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                });
            }
    });
</script>
{{--
<script>
    document.addEventListener('click', function(e) {
        if (!e.target.classList.contains('change-status')) return;

        let isChecked = e.target.checked;
        let id = e.target.dataset.id;

        fetch("{{ route('admin.products-variant-item.change-status', ['product' => $product->id, 'variant' => $variant->id]) }}", {
                method: "PUT",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id: id,
                    status: isChecked,
                }),
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: data.message,
                });
            });
    });
</script> --}}
