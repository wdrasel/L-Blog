

<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name') !!}
    {!! Form::text('name', Null ,['class'=>'form-control']) !!}

    @if($errors->has('name'))
        <spam class="help-block">{{$errors->first('name')}}</spam>
    @endif
</div>

<div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
    {!! Form::label('slug') !!}
    {!! Form::text('slug', Null ,['class'=>'form-control']) !!}

    @if($errors->has('slug'))
        <spam class="help-block">{{$errors->first('slug')}}</spam>
    @endif
</div>

<div class="form-group  {{$errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email','Email') !!}
    {!! Form::email('email', Null  ,['class'=>'form-control']) !!}

    @if($errors->has('email'))
        <spam class="help-block">{{$errors->first('email')}}</spam>
    @endif
</div>

<div class="form-group  {{$errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password','Password') !!}
    {!! Form::password('password' ,['class'=>'form-control']) !!}

    @if($errors->has('password'))
        <spam class="help-block">{{$errors->first('password')}}</spam>
    @endif
</div>
<div class="form-group  {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
    {!! Form::label('password_confirmation','password_confirmation') !!}
    {!! Form::password('password_confirmation'  ,['class'=>'form-control']) !!}

    @if($errors->has('password_confirmation'))
        <spam class="help-block">{{$errors->first('email')}}</spam>
    @endif
</div>
<div class="form-group  {{$errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('role','Role') !!}
    @if($user->exists && ($user->id == 1)|| isset($hideRoleDropdown) )
        {!! Form::hidden('role',$user->roles->first()->display_name) !!}
        <p class="from-control-static">{{$user->roles->first()->display_name}}</p>
    @else
        {!! Form::select('role'  ,\App\Role::pluck('display_name' ,'id'),$user->exists ? $user->roles->first()->id: null,['class'=>'form-control','placeholder'=> 'Choose a role']) !!}
    @endif

    @if($errors->has('role'))
        <spam class="help-block">{{$errors->first('role')}}</spam>
    @endif
</div>

<div class="form-group {{$errors->has('bio') ? 'has-error' : ''}}">
    {!! Form::label('bio') !!}
    {!! Form::textarea('bio', Null ,['rows'=> 5 ,'class'=>'form-control']) !!}

    @if($errors->has('bio'))
        <spam class="help-block">{{$errors->first('bio')}}</spam>
    @endif
</div>

<div>
    <button type="submit" class="btn btn-primary">{{$user->exists ? 'Update User': 'Add User'}}</button>
    <a href="{{route('users.index')}}" class="btn btn-default">Cancel</a>
</div>


