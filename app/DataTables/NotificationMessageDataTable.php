<?php
/*
 * File name: NotificationMessageDataTable.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\DataTables;

use App\Models\NotificationMessage;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class NotificationMessageDataTable extends DataTable
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
            ->editColumn('created_at', function ($notification_message) {
                return getDateColumn($notification_message, 'created_at');
            })
            ->editColumn('title', function ($notification_message) {
                return $notification_message->title;
            })
            ->editColumn('status', function ($notification_message) {
                return $notification_message->status ? 'Sent' : 'In Progress';
            })
            ->addColumn('action', 'notification_messages.datatables_actions')
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
        return [
            [
                'data' => 'title',
                'title' => trans('lang.notification_message_title'),
                'searchable' => false,
            ],
            [
                'data' => 'status',
                'title' => trans('lang.notification_message_status'),
                'searchable' => false,
            ],
            [
                'data' => 'created_at',
                'title' => trans('lang.notification_message_created_at'),
                'searchable' => false,
            ]
        ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param NotificationMessage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(NotificationMessage $model)
    {
        return $model->newQuery()->select("$model->table.*");
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
        return 'notification_messages_datatable_' . time();
    }
}
