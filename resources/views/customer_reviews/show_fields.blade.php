<!-- Id Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('id', 'ID:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->id !!}</p>
    </div>
</div>

<!-- Review Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('review', 'Review:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->review !!}</p>
    </div>
</div>

<!-- Rate Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('rate', 'Rate:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->rate !!}</p>
    </div>
</div>

<!-- Booking Id Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('booking_id', 'Booking ID:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->booking_id !!}</p>
    </div>
</div>

<!-- User Id Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('user_id', 'Provider:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->user->name !!}</p>
    </div>
</div>

<!-- Booking Id Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('booking.user.id', 'Customer:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->booking->user->name !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('created_at', 'Created At:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group align-items-baseline d-flex">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'control-label text-md-right mx-1']) !!}
    <div class="col-md-9">
        <p>{!! $customerReview->updated_at !!}</p>
    </div>
</div>


