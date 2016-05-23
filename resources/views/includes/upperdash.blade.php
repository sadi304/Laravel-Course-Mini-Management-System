            <div class="upper-dash">
            <div class="row">
               <div class="col-sm-offset-10 col-sm-2">
                   <a href="{{ route('logout') }}" class="btn btn-default btn-block btn-bs">
                       log out
                   </a>
               </div>
               
                <div class="col-sm-6">
                    <div class="box">
                        
                        @if ( Auth::user()->role == 'student' ) 
                        <div class="title">
                            <h4>Latest Posts in Your Department</h4>
                        </div>
                        @else 
                        <div class="title">
                            <h4>Post a new notice</h4>
                        </div>
                        <a href="#modal" class="btn btn-medium btn-bs pop-btn btn-block"> Create Post </a>
                        <h3 style="margin: 30px 40px 0 40px"> Your All Posts </h3>
                        @endif
                        <ul class="upload-files">
                            @foreach( $posts as $post )
                                <li> <a href=" {{ $post->id }} " class="post-link"> {{ $post->created_at->diffForHumans() }} - {{ $post->title }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="title">
                            <h4>Date</h4>
                        </div>
                        <div class="dates">
                            <div class="day">
                                {{ Carbon::now('Asia/Almaty')->format('l') }}
                            </div>
                            <div class="date">
                                {{ Carbon::now('Asia/Almaty')->format('jS \\of F Y') }}
                            </div>
                            <div class="time">
                                {{ Carbon::now('Asia/Almaty')->format('h:i:s A') }}
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="title">
                            <h4>User Info</h4>
                        </div>
                        <p>Todays is 20/10/2013</p>
                    </div>
                </div>

            </div>
            </div>