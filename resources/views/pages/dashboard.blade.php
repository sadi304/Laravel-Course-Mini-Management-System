@extends('base')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/remodal.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/remodal-default-theme.css') }}">
@endsection

@section('content')
   
    <section id="dashboard">
        <div class="container">
           @include('includes.upperdash')
            <div class="row">
                <div class="col-sm-6">
                    <div class="box">
                        <div class="title">
                            <h4>Last Uploaded Files By You</h4>
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

    <div class="remodal modal-style" data-remodal-id="modal">
        <button data-remodal-action="close" class="remodal-close"></button>

        {!! Form::open(['url' => 'createPost', 'class' => 'form-upload form-horizontal']) !!}
            <div class="col-sm-9 col-sm-offset-3" style="text-align: right; margin-bottom: 30px">
                <h3>Create a New Post</h3>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Title', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::text('title', '', ['class' => 'form-control form-bs']) !!}
                </div>

            </div>
            
            <div class="form-group">
                {!! Form::label('body', '', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('body', '', ['class' => 'form-control form-bs']) !!}
                </div>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-3">
                    {!! Form::submit('Submit',['class' => 'btn btn-default btn-bs btn-post btn-block']) !!}   
                </div>
            </div>

        {!! Form::close() !!}

    </div>
    <div class="remodal" data-remodal-id="modal2">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="media">
          <div class="media-body">
            <h3 class="media-heading post-title-show">
                
            </h3>
            <p class="post-date col-sm-6">
                
            </p>
            <p class="post-author col-sm-6">
                
            </p>
            <p class="post-body-show">
                
            </p>
          </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script src="{{ URL::asset('js/remodal.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.btn-post').click(function(e){  
                //
                e.preventDefault();  
                 
                $.ajax({
                    url: '/createPost',
                    type: 'post',
                    data: {
                        'title': $('input[name=title]').val(), 
                        'body': $('textarea[name=body]').val(),
                        '_token': $('input[name=_token]').val()
                    },
                    success: function(data){
                        if (data.success == 1) {
                            alert('Post was created successfully');
                            $('[data-remodal-id=modal]').remodal().close();
                            window.location.href = "{{URL::to('/')}}"
                        }
                        else {
                            alert('There were errors in inserting the post');                        }
                    },
                    error: function(data) {
                        //console.log(data);
                    }
                });
                    
            });
        });

        $('.post-link').click(function(e){
            e.preventDefault();
            alert('/getPost/'+$(this).attr('href').trim()); 
                   
                $.ajax({
                    url: '/getPost/'+$(this).attr('href').trim(),
                    type: 'get',
                    success: function(data){
                        $('[data-remodal-id=modal2]').remodal().open();
                        $('.post-title-show').text(data.title);
                        $('.post-date').text(data.date);
                        $('.post-body-show').html(data.body);
                        $('.post-author').text(data.author);                     
                    },
                    error: function(data) {
                        //console.log(data);
                    }
                });
            
        });
            
    </script>
@endsection