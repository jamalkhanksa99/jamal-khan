<div class="d-flex flex-column col-sm-12 col-md-6">
    <!-- Name Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('title', trans("lang.complain_title"), ['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {{$complain->title}}
        </div>
    </div>

    <!-- Description Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('description', trans("lang.complain_description"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {{$complain->description}}
        </div>
    </div>

</div>
<div class="d-flex flex-column col-sm-12 col-md-6">

    <!-- Customer Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('user.name', trans("lang.complain_user_id"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {{$complain->user->name}}
        </div>
    </div>
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('user.email', trans("lang.complain_user_email"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {{$complain->user->email}}
            <button type="button" class="btn bg-{{setting('theme_color')}}" onclick="location.href='mailto:{{$complain->user->email}}?subject={{trans('lang.complain_number')}} #{{$complain->id}}&body={{trans('lang.complain_content')}}: %0D%0A{{$complain->description}}';">{{trans('lang.complain_reply')}}</button>
        </div>
    </div>
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('user.phone_number', trans("lang.complain_user_phone_number"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!}
        <div class="col-md-9">
            {{$complain->user->phone_number}}
        </div>
    </div>

    <!-- Status Field -->
    <div class="form-group align-items-baseline d-flex flex-column flex-md-row">
        {!! Form::label('status', trans("lang.complain_solved"),['class' => 'col-md-3 control-label text-md-right mx-1']) !!} {!! Form::hidden('status', 0, ['id'=>"hidden_status"]) !!}
        <div class="col-md-9 icheck-{{setting('theme_color')}}">
            {!! Form::checkbox('status', 1, null) !!} <label for="status"></label>
        </div>
    </div>

</div>

<!-- Submit Field -->
<div class="form-group col-12 d-flex flex-column flex-md-row justify-content-md-end justify-content-sm-center border-top pt-4">
    <button type="submit" class="btn bg-{{setting('theme_color')}} mx-md-3 my-lg-0 my-xl-0 my-md-0 my-2">
        <i class="fas fa-save"></i> {{trans('lang.save')}} {{trans('lang.complain')}}</button>
    <a href="{!! route('complains.index') !!}" class="btn btn-default"><i
                class="fas fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
