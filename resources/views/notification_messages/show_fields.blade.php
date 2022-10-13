<!-- Id Field -->
<div class="form-group row col-6">
    {!! Form::label('id', 'Id:', ['class' => 'col-md-3 control-label mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $notificationMessage->id !!}</p>
    </div>
</div>

<!-- Title Field -->
<div class="form-group row col-6">
    {!! Form::label('title', 'Title:', ['class' => 'col-md-3 control-label mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $notificationMessage->title !!}</p>
    </div>
</div>

<!-- Content Field -->
<div class="form-group row col-6">
    {!! Form::label('content', 'Content:', ['class' => 'col-md-3 control-label mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $notificationMessage->content !!}</p>
    </div>
</div>

<!-- Status Field -->
<div class="form-group row col-6">
    {!! Form::label('status', 'Status:', ['class' => 'col-md-3 control-label mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $notificationMessage->status ? 'Sent' : 'In Progress' !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group row col-6">
    {!! Form::label('created_at', 'Created At:', ['class' => 'col-md-3 control-label mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $notificationMessage->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group row col-6">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-md-3 control-label mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $notificationMessage->updated_at !!}</p>
    </div>
</div>

