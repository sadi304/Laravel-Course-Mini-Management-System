@extends('base')


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
                                    
                                    </span> <a href="{{ route('getupload', ['filename' => $upload->name]) }}">{{ $upload->name }}</a> {{ $upload->created_at->diffForHumans() }} <a href="{{ route('deletefile', ['uploadid' => $upload->id]) }}"><span class="label label-success">Remove</span>  </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection