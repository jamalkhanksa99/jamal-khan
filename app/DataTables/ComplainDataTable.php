<?php
/*
 * File name: ComplainDataTable.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\Complain;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class ComplainDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        return $dataTable
            ->editColumn('updated_at', function ($complain) {
                return getDateColumn($complain, 'updated_at');
            })
            ->editColumn('status', function ($complain) {
                return getBooleanColumn($complain, 'status');
            })
            ->editColumn('user.name', function ($complain) {
                return getLinksColumnByRouteName([$complain->user], 'users.edit', 'id', 'name');
            })
            ->addColumn('action', 'complains.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'title',
                'title' => trans('lang.complain_title'),

            ],
            [
                'data' => 'description',
                'title' => trans('lang.complain_description'),

            ],
            [
                'data' => 'user.name',
                'title' => trans('lang.complain_user_id'),

            ],
            [
                'data' => 'status',
                'title' => trans('lang.complain_solved'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.complain_updated_at'),
                'searchable' => false,
            ]
        ];
        $columns = array_filter($columns);

        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Complain $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Complain $model)
    {
        return $model->newQuery()->with("user")->select("$model->table.*");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title' => trans('lang.actions'), 'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'complainsdatatable_' . time();
    }
}
