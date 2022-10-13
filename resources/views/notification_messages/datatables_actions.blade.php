<div class='btn-group btn-group-sm'>
    @can('notificationMessages.show')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.view_details')}}" href="{{ route('notificationMessages.show', $id) }}" class='btn btn-link'>
            <i class="fas fa-eye"></i> </a>
    @endcan

    @can('notificationMessages.edit')
        <a data-toggle="tooltip" data-placement="left" title="{{trans('lang.notification_message_edit')}}" href="{{ route('notificationMessages.edit', $id) }}" class='btn btn-link'>
            <i class="fas fa-edit"></i> </a>
    @endcan

    @can('notificationMessages.destroy')
        {!! Form::open(['route' => ['notificationMessages.destroy', $id], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fas fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-link text-danger',
        'onclick' => "return confirm('Are you sure?')"
        ]) !!}
        {!! Form::close() !!}
  @endcan
</div>
