<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            // ✅ Name column (translations)
            ->addColumn('name', function ($item) {
                $locale = app()->getLocale();
                $translation = $item->translations->firstWhere('locale', $locale);

                return $translation->name ?? '-';
            })

            // ✅ Variant name column
            ->addColumn('variant_name', function ($item) {
                return $item->variant->name ?? '-';
            })

            // ✅ Is Default column
            ->addColumn('is_default', function ($item) {
                return $item->is_default
                    ? '<span class="badge badge-success">default</span>'
                    : '<span class="badge badge-danger">no</span>';
            })

            // ✅ Status toggle column
            ->addColumn('status', function ($item) {
                $checked = $item->status ? 'checked' : '';

                return '
                    <label class="custom-switch mt-2">
                        <input type="checkbox" ' . $checked . '
                               class="custom-switch-input change-status"
                               data-id="' . $item->id . '">
                        <span class="custom-switch-indicator"></span>
                    </label>
                ';
            })

            // ✅ Action buttons (Edit + Delete)
            ->addColumn('action', function ($item) {

                $editUrl = route('admin.products-variant-item.edit', [
                    'product' => $item->productVariant->product_id,
                    'variant' => $item->product_variant_id,
                    'item'    => $item->id,
                ]);

                $deleteUrl = route('admin.products-variant-item.destroy', [
                    'product' => $item->productVariant->product_id,
                    'variant' => $item->product_variant_id,
                    'item'    => $item->id,
                ]);

                return "
                    <a href='{$editUrl}' class='btn btn-primary'>
                        <i class='far fa-edit'></i>
                    </a>

                    <form method='POST' action='{$deleteUrl}' style='display:inline-block;'
                          onsubmit='return confirm(\"Are you sure?\")'>
                        " . csrf_field() . method_field('DELETE') . "
                        <button type='submit' class='btn btn-danger ml-2'>
                            <i class='far fa-trash-alt'></i>
                        </button>
                    </form>
                ";
            })

            // ✅ Allow HTML rendering
            ->rawColumns(['name', 'status', 'action', 'is_default'])
            ->setRowId('id');
    }

    /**
     * Build query with eager loading.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        $variant_id = request()->input('variant');

        return $model->where('product_variant_id', $variant_id);
    }

    /**
     * HTML builder for the table.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productvariantitem-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Define columns.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(60),
            Column::make('name'),
            Column::make('variant_name'),
            Column::make('price'),
            Column::make('is_default'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(180)
                ->addClass('text-center'),
        ];
    }

    /**
     * Filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
