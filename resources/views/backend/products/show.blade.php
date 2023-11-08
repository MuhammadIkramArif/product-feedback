@extends('layouts.admin',['title' => 'Feedback'])

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $singular }}</h4>
                        <a class="btn btn-primary float-right" href="{{ route($url.'index') }}"><i
                                class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table datatable table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Comment</th>
                                            <th>Vote</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $comment = \App\Models\Comment::where('product_id', $model->id)->get();
                                        @endphp
                                        @foreach($comment as $item)
                                            <tr>
                                                <td>{{ $item->product->user->name }}</td>
                                                <td>{{ $item->comment }}
                                                <input type="hidden" name="comment_id" class="comment_id" value="{{ $item->id }}"></td>
                                                @php
                                                $vote = \App\Models\UserVote::where('comment_id', $item->id)->where('user_id',$item->product->user->id )->first();
                                                $count = \App\Models\UserVote::where('comment_id',$item->id)->count();
                                                @endphp
                                                <td><i data-check="{{ $vote ? '1' : '0' }}" style="{{ $vote ? 'color:#7367F0' :'color:#626262' }}" class="fa fa-thumbs-up" onclick="toggleVote(this)"></i><span class="count_vote">{{ $count  }}</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {!! Form::open(['url' => route($url . 'comment_store', $model->slug), 'files' => true, 'method' => 'put']) !!}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="comment">Comments</label>
                                        {!! Form::textarea('comment', old('comment'), ['id' => 'comment', 'class' => 'form-control']) !!}
                                        @error('comment')
                                        <div class="small text-danger">{!! $message !!}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mt-2">Submit</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>

    <script>
        function toggleVote(element)
        {
            var check;

            if ($(element).attr('data-check') == '1')
            {
                check = 0;
                $(element).css("color",'#626262');
                $(element).attr('data-check','0');

            }
            else {
                check = 1;
                $(element).css("color",'#7367F0');
                $(element).attr('data-check','1');

            }
            $.ajax({
                url: "http://127.0.0.1:8000/account/products/vote",
                method: "POST",
                type: "json",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    check:check,
                    comment_id:$(element).closest("tr").find(".comment_id").val()
                },
                success: function(res) {
                    if (res.data.status) {
                        $(element).closest("tr").find(".count_vote").html(res.data.html)
                    } else {

                    }
                },
                errors: function(err) {
                    alert(error);
                },
            });

        }
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                responsive: true,
            });
        });
    </script>
@endsection
