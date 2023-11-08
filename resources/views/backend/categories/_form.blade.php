<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('name', old('name', $model->name), ['id' => 'name', 'class' => 'form-control' ]) !!}
            @error('name')
            <div class="small text-danger">{!! $message !!}</div>
            @enderror
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary waves-effect waves-light mt-2">Submit</button>

@section('js')
@endsection

@push('css')
@endpush

@push('js')
@endpush
