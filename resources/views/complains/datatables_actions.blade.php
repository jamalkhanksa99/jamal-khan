<div class='btn-group btn-group-sm'>
    @can('complains.edit')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.complain_edit')}}"
           href="{{ route('complains.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a>
    @endcan

    @can('complains.destroy')
        {!! Form::open(['route' => ['complains.destroy', $id], 'method' => 'delete']) !!} {!! Form::button('<i class="fas fa-trash"></i>', [ 'type' => 'submit', 'class' => 'btn btn-link text-danger', 'onclick' => "return confirm('Are you sure?')" ]) !!} {!! Form::close() !!}
    @endcan
</div>
