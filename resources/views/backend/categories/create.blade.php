@extends('layouts.admin', ['title' => 'Create'])
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $singular }}</h4>
                        <a class="btn btn-primary float-right" href="{{ route($url . 'index') }}"><i
                                class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::open(['route' => $url . 'store', 'files' => true, 'method' => 'post', 'files' => true]) !!}
                            @include($dir . '_form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
