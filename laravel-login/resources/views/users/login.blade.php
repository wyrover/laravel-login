@extends('baselayout')

@section('title')
    Login
@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Log in</h2>
        <p>Hi, here you can login to your account. Just fill in the form and press Sign In button.</p>        

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(array('url' => 'users/login','class'=>'form')) !!}

        

        <br>{!! Form::label('email', 'E-Mail Address') !!}
        {!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'example@gmail.com')) !!}
        <br>{!! Form::label('password', 'Password') !!}
        {!! Form::password('password', array('class' => 'form-control')) !!}
        <br>
        {!! Form::submit('Sign In' , array('class' => 'btn btn-primary')) !!}
        
        {!! Form::close() !!}
        <br>

        <br>
    </div>
</div>

@stop