<a href="{{ route($url.'edit', $model->slug) }}" title="Edit Category" class="btn btn-md btn-link">
    <i class="fa fa-edit"></i>
</a>


@if($model->trashed())
    <a class="btn btn-md btn-link" title="Restore Category" data-toggle="modal" href="#modal-{{ $model->slug }}">
        <span class="fa fa-check"></span>
    </a>

    <div class="modal fade" id="modal-{{ $model->slug }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Restore</h4>
                </div>
                <div class="modal-body text-center text-warning">
                    <div class="form-group">
                        <i class="fa fa-exclamation-circle fa-3x"></i>
                    </div>
                    <div class="form-group">
                        Are you Sure?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::open(['url' => route($url.'restore', $model->slug), 'method' => 'put']) !!}
                    <button type="submit" class="btn btn-danger">Restore</button>
                    {!! Form::close() !!}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@else
    <a class="btn btn-md btn-link" title="Delete Category" data-toggle="modal" href="#modal-{{ $model->slug }}">
        <span class="fa fa-trash"></span>
    </a>
    <div class="modal fade" id="modal-{{ $model->slug }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body text-center text-warning">
                    <div class="form-group">
                        <i class="fa fa-exclamation-circle fa-3x"></i>
                    </div>
                    <div class="form-group">
                        Are you Sure?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::open(['url' => route($url.'destroy', $model->slug), 'method' => 'delete']) !!}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    {!! Form::close() !!}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--<a href="{{ route($url.'', $model->slug) }}" class="btn btn-sm btn-link">--}}
    {{--    <i class="fa fa-link"></i>--}}
    {{--</a>--}}
@endif
