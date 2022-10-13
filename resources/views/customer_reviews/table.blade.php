@push('css_lib')
    @include('layouts.datatables_css')
    <style>
        .dataTables_filter, .dataTables_info {
            display: none;
        }
    </style>
@endpush

{!! $dataTable->table(['width' => '100%']) !!}

@push('scripts_lib')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush