<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'brand.action')
            ->addColumn('logo', function($query){
                return $img = "<img width='100px' src='".asset($query->logo)."'></img>";
            })
            ->addColumn('action', function($query){
                $edit = '<a href="'.route('admin.brand.edit', $query->id).'" class="btn btn-primary">Edit</a>';
                $delete = '<a href="'.route('admin.brand.destroy', $query->id).'" class="btn btn-danger ml-2 delete-item">Delete</a>';
                return $edit.$delete;
            })
            ->addColumn('status', function($query){
                if($query->status == 1){
                    $button = '<label class="custom-switch">
                                    <input type="checkbox" checked name="checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                                    <span class="custom-switch-indicator"></span>
                                </label>';
                }else{
                    $button = '<label class="custom-switch">
                                    <input type="checkbox" name="checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                                    <span class="custom-switch-indicator"></span>
                                </label>';
                }
                return $button;
            })
            ->addColumn('is_featured', function($query){
                if($query->is_featured == 1){
                    $button = '<label class="custom-switch">
                                    <input type="checkbox" checked name="checkbox" data-id="'.$query->id.'" class="custom-switch-input change-is_featured">
                                    <span class="custom-switch-indicator"></span>
                                </label>';
                }else{
                    $button = '<label class="custom-switch">
                                    <input type="checkbox" name="checkbox" data-id="'.$query->id.'" class="custom-switch-input change-is_featured">
                                    <span class="custom-switch-indicator"></span>
                                </label>';
                }
                return $button;
            })
            ->rawColumns(['logo', 'status', 'action', 'is_featured'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(100),
            Column::make('logo')->width(200),
            Column::make('name')->width(350),
            Column::make('status'),
            Column::make('is_featured'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
