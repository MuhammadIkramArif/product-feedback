<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            @php
                $categories = \App\Models\Category::select('name', 'id')->get()->pluck('name', 'id')->prepend('--Select--', '0');
            @endphp
            <label for="category">Companies</label>
            {!! Form::select('category', $categories, old('category', $model->category->id ?? ''), ['id' => 'category', 'class' => 'form-control']) !!}
            @error('category')
            <div class="small text-danger">{!! $message !!}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="title">Title</label>
            {!! Form::text('title', old('title', $model->title), ['id' => 'title', 'class' => 'form-control' ]) !!}
            @error('title')
            <div class="small text-danger">{!! $message !!}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="description">Description</label>
            {!! Form::textarea('description', old('description', $model->description), ['id' => 'description', 'class' => 'form-control']) !!}
            @error('description')
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
