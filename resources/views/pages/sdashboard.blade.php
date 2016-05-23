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
                <div class="col-sm-12">
                    <div class="box">
                        <div class="title">
                            <h4>Last Uploads</h4>
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
                                    
                                    </span> <a href="{{ route('getupload', ['filename' => $upload->name]) }}">{{ $upload->name }}</a> {{ $upload->created_at->diffForHumans() }} <a href="{{ route('deletefile', ['uploadid' => $upload->id]) }}"> </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="remodal" data-remodal-id="modal2">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div class="media">
          <div class="media-body">
            <h3 class="media-heading post-title-show">
                
            </h3>
            <p class="post-date">
                
            </p>
            <p class="post-author">
                
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
        $('.post-link').click(function(e){
            e.preventDefault();
            alert('/getPost/'+$(this).attr('href').trim());          
            $.ajax({
                url: '/getPost/'+$(this).attr('href').trim(),
                type: 'get',
                success: function(data){
                    $('[data-remodal-id=modal2]').remodal().open();
                    $('.post-title-show').text(data.title);
                    $('.post-date').text('Published at: '+data.date);
                    $('.post-body-show').html(data.body);
                    $('.post-author').text('Teacher Name: '+data.author);                    
                },
                error: function(data) {
                    //console.log(data);
                }
            });
        });
    </script>
@endsection