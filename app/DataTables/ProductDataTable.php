<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\ChildCategory;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('thumb_image', function($query){
                return $img = "<img width='100px' src='".asset($query->thumb_image)."'></img>";
            })
            ->addColumn('action', function($query){
                $edit = '<a href="'.route('admin.product.edit', $query->id).'" class="btn btn-primary"><i class="fa-solid fa-edit"></i></a>';
                $delete = '<a href="'.route('admin.product.destroy', $query->id).'" class="btn btn-danger ml-2 delete-item"><i class="fa fa-trash"></i></a>';
                $settings = '<div class="btn-group dropleft ml-2">
                      <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-gear"></i>
                      </button>
                      <div class="dropdown-menu dropleft">
                        <a class="dropdown-item" href="'.route('admin.product-image-gallery.index', ['product'=>$query->id]).'">Image Gallery</a>
                        <a class="dropdown-item" href="'.route('admin.product-variant.index', ['productss'=>$query->id]).'">Variants</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
                    </div>';
                return $edit.$delete.$settings;
            })
            ->addColumn('product_type', function($query){
                switch($query->product_type){
                    case 'new_arrival':
                        return '<i class="badge badge-success">New Arrival</i>';
                        break;
                    case 'featured':
                        return '<i class="badge badge-success">Featured</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge badge-success">Top Product</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge badge-success">Best Product</i>';
                        break;
                    default:
                        return '<i class="badge badge-dark">None</i>';
                        break;
                }
            })
            // ->addColumn('category', function(ChildCategory $query){
            //     return $query->category->name;
            // })
            // ->addColumn('sub_category', function(ChildCategory $query){
            //     return $query->subCategory->name;
            // })
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
            ->rawColumns(['thumb_image', 'status', 'action', 'product_type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('id'),
            Column::make('name'),
            Column::make('price'),
            Column::make('thumb_image'),
            Column::make('product_type'),
            Column::make('status'),
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
        return 'Product_' . date('YmdHis');
    }
}
