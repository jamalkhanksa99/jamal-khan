<?php
/*
 * File name: CustomerReviewDataTable.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\CustomerReview;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class CustomerReviewDataTable extends DataTable
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
        $dataTable = $dataTable
            ->editColumn('updated_at', function ($customerReview) {
                return getDateColumn($customerReview, 'updated_at');
            })
            ->editColumn('user.name', function ($customerReview) {
                return getLinksColumnByRouteName([$customerReview->user], 'users.edit', 'id', 'name');
            })
            ->editColumn('booking.user.name', function ($customerReview) {
                return getLinksColumnByRouteName([$customerReview->booking->user], 'users.edit', 'id', 'name');
            })
            ->addColumn('action', 'customer_reviews.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
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
                'data' => 'review',
                'title' => trans('lang.customer_review_review'),

            ],
            [
                'data' => 'rate',
                'title' => trans('lang.customer_review_rate'),

            ],
            [
                'data' => 'user.name',
                'title' => trans('lang.customer_review_user_id'),

            ],
            [
                'name' => 'booking.user.name',
                'data' => 'booking.user.name',
                'title' => trans('lang.booking_user_id'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.customer_review_updated_at'),
                'searchable' => false,
            ]
        ];

        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param CustomerReview $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CustomerReview $model)
    {
        if (auth()->user()->hasRole('admin')) {
            return $model->newQuery()->with("user")->with("booking")->select("$model->table.*");
        }
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
        return 'customer_reviewsdatatable_' . time();
    }
}
