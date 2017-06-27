@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">upload cv</div>

                <div class="panel-body">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form class="form-horizontal" action="/cvupload" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="file" class="col-sm-2 control-label">cv:</label>
                            <div class="col-sm-10">
                                <input id="file" type="file" name="file">
                            </div>
                            
                        </div>
                        
                        <input class="col-sm-12 btn btn-default" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
