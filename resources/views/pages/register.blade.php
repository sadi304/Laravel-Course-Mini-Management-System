@extends('base')


@section('content')
   
    <section id="login">
       @if( count($errors) > 0 ) 
           @foreach( $errors->all() as $error)
               <h1>{{ $error }}</h1>
           @endforeach
       @endif
        <div class="login-panel">
            {!! Form::open(['url' => 'signup','class' => 'form-horizontal']) !!}
            
            <div class="form-group">
                {!! Form::label('name', 'Name', array('class' => 'col-sm-3')) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', 'Your Name',['class' => 'form-control form-bs']) !!}
                </div>
                
            </div>
            
            <div class="form-group">
                {!! Form::label('email', 'E-Mail Address', array('class' => 'col-sm-3')) !!}
                <div class="col-sm-9">
                    {!! Form::text('email', 'example@gmail.com',['class' => 'form-control form-bs']) !!}
                </div>
                
            </div>
            
            <div class="form-group">
                {!! Form::label('password', 'password', array('class' => 'col-sm-3')) !!}
                <div class="col-sm-9">
                    {!! Form::password('password',['class' => 'form-control form-bs']) !!}
                </div>
                
            </div>
            
            <div class="form-group">
                {!! Form::label('role', 'Select Role', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::select('role', [ 'teacher' => 'Teacher' , 'student' => 'Student' ], null, ['class' => 'select_role form-control form-bs']) !!}
                </div>

            </div>
            
            <div class="form-group">
                {!! Form::label('dept_id', 'Select Department', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::select('dept_id', [ '1' => 'MCE' , '2' => 'TVE', '3' => 'EEE', '4' => 'CSE', '5' => 'CEE' ], null, ['class' => 'form-control form-bs']) !!}
                </div>

            </div>
            
            <div class="form-group group-id" style="display:none;">
                {!! Form::label('student_id', 'Student ID', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-9">
                    {!! Form::text('student_id', '999999',['class' => 'form-control form-bs']) !!}
                </div>

            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    {!! Form::submit('Submit',['class' => 'btn btn-default']) !!}   
                </div>
            </div>
            
            {!! Form::close() !!}
        </div>
    </section>
    
@endsection


@section('scripts')
    <script>
        $(function() {
            $('.select_role').on('change', function() {
                if( $(this).val() == 'student' ) {
                    $('.group-id').fadeIn('slow');
                }
                else {
                    $('.group-id').fadeOut('slow');
                }
            });
        })
    </script>
@endsection