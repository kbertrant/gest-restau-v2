@extends('main')

@section('title', ' - Profile')


@section('main-content')
<div class="container col-lg-8">
    <form class=" col-xs-12">
        <form  method="POST" action="{{ route('updateprofile') }}" class="form-login">
           
            @csrf
            <h2>Your informations</h2>

            <div class="login-wrap">
                <input id="name" type="text" class="shadow form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       name="name" value="{{ Auth::user()->name }}" disabled autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
                <br>
                <input id="email" type="email"
                       class="shadow form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                        value="{{ Auth::user()->email }}" disabled>
                <br>
                <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                value="{{ Auth::user()->password }}" disabled>
        
                  <br/>
                <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone }}"
                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} shadow"  disabled />
                <br/>

                <input type="date" name="birth" id="birth" value="{{ Auth::user()->birth }}"
                class="form-control{{ $errors->has('birth') ? ' is-invalid' : '' }} shadow"  disabled />
                <br/>

                <input type="text" name="address" id="address" value="{{ Auth::user()->address }}"
                class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }} shadow"  disabled />
                <br/>
                <select name="gender" id="gender" class="form-control pro shadow" disabled>
                        <option value="Masculin" {{ ($user->gender == "Masculin") ? 'selected' : '' }}>Male </option>
                        <option value="Féminin" {{ ($user->gender == "Féminin") ? 'selected' : '' }}>Female</option>
                    </select>
                <br>
                <select id="grp_id" name="grp_id" class="form-control centered shadow" disabled>
                    <option>Select groupe</option>
                    @foreach ($list_groupes as $list_groupe)
                        <option value="{{ $list_groupe->id }}"{{ ($user->grp_id == $list_groupe->id) ? 'selected' : '' }}>{{ $list_groupe->name }}</option>
                    @endforeach
                </select>
                <br>
            </div>
        </form>
    </div>
</div><br>        
    </div>
</div>
@endsection