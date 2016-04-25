@extends('base')


@section('content')
   
    <section id="dashboard">
        <div class="container">
           @include('includes.upperdash')
            <div class="row">
                <div class="col-sm-6">
                    <div class="box">
                        <div class="title">
                            <h4>Last Uploads by you</h4>
                        </div>
                        <ul class="upload-files">
                            @foreach( $uploads as $upload )
                                <li> <span class="label label-{{ $upload->level }}">
                                    
                                    @if ( $upload->level === 'primary' )
                                         Notice
                                    @elseif ( $upload->level === 'danger' )
                                         Important
                                    @else 
                                         Info
                                    @endif 
                                    
                                    </span> <a href="{{ route('getupload', ['filename' => $upload->name]) }}">{{ $upload->name }}</a> {{ $upload->created_at->diffForHumans() }} <a href="{{ route('deletefile', ['uploadid' => $upload->id]) }}"><span class="label label-success">Remove</span>  </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box">
                        <div class="title">
                            <h4> Upload a File </h4>
                        </div>
                        {!! Form::open(['url' => 'uploadfile', 'files' => true, 'class' => 'form-upload form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('course', 'Select Course', ['class' => 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('course', $courses, null, ['class' => 'form-control form-bs']) !!}
                            </div>

                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('level', 'Select Level', ['class' => 'col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('level', [ 'primary' => 'Notice', 'danger' => 'Important' , 'info' => 'Information' ], null, ['class' => 'form-control form-bs']) !!}
                            </div>

                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('file', 'Upload', array('class' => 'col-sm-3')) !!}
                            <div class="col-sm-9">
                                {!! Form::file('file') !!}
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                {!! Form::submit('Submit',['class' => 'btn btn-default btn-bs']) !!}   
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection