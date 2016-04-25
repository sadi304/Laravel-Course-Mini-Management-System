            <div class="upper-dash">
            <div class="row">
               <div class="col-sm-offset-10 col-sm-2">
                   <a href="{{ route('logout') }}" class="btn btn-default btn-block">
                       log out
                   </a>
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
                <div class="col-sm-6">
                    <div class="box">
                        <div class="title">
                            <h4>Today's Classes & Labs</h4>
                        </div>
                        <p>Todays is 20/10/2013</p>
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