<div class='btn-group btn-group-sm'>
    @can('customerReviews.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}"
           href="{{ route('customerReviews.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a>
    @endcan

    @can('customerReviews.destroy')
        {!! Form::open(['route' => ['customerReviews.destroy', $id], 'method' => 'delete']) !!} {!! Form::button('<i class="fas fa-trash"></i>', [ 'type' => 'submit', 'class' => 'btn btn-link text-danger', 'onclick' => "return confirm('Are you sure?')" ]) !!} {!! Form::close() !!}
    @endcan
</div>
