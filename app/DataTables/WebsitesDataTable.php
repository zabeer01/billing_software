<?php

namespace App\DataTables;

use App\Models\Website;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder;


class WebsitesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $file_name = 'websites';
                return '<a href="' . route($file_name.'.edit', $row->id) . '">
                            <i class="fa-solid fa-pen-to-square" style="color: #74C0FC;"></i>
                        </a>
                        <form method="POST" action="' . route($file_name.'.destroy', $row->id) . '" style="display: inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                                <i class="fa-solid fa-trash" style="color: #ff2e2e;"></i>
                            </button>
                        </form>';
            })
            ->addColumn('status', function ($row) {
                return $row->status == 'Active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" value="'.$row->id.'">';
            })
            
            ->setRowId('id')
            ->rawColumns(['action', 'status','checkbox']);
    }
    

    /**
     * Get the query source of dataTable.
     */
    public function query(Website $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('websites-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'buttons' => [
                            Button::make('excel'),
                            Button::make('csv'),
                            Button::make('pdf'),
                            Button::make('print'),
                            Button::make('reset'),
                            Button::make('reload')
                        ],
                    ]);
    }
    
    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
          
            Column::make('id'),
            Column::make('name'),
            Column::make('url'),
            Column::make('bill'),
            Column::computed('status')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
          
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Websites_' . date('YmdHis');
    }
}
