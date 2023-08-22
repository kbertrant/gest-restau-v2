@extends('main')

@section('title', ' - Modifier Utilisateurs')


@section('main-content')
<div class="container col-lg-8">
    <br>
    <h2>Sélect user to update</h2>
    <br>
    <select id="usr_id" name="usr_id" onchange="getUser();" class="form-control shadow centered">
        <option>Sélectionner un utilisateur</option>
        @foreach ($list_users as $list_user)
            <option value="{{ $list_user->id }}">{{ $list_user->name }}</option>
        @endforeach
    </select>
    <br>
    <h2>Update informations </h2>
    <br>
    <form method="POST" action="{{ route('personnels.update') }}"> 
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
        <input type="text" name="name" id="name" value="{{ $user->name }}"
                       class="form-control shadow"  required />
        <br/>
        <input type="email" name="email" id="email" value="{{ $user->email }}"
                       class="form-control shadow"  required />
        <br/>
        <input type="password" name="password" id="password" placeholder="Nouveau mot de passe (facultatif)"
                class="form-control shadow" />
        <br/>
        <input type="text" name="poste" id="poste" value="{{ $user->poste }}"
                       class="form-control shadow"  required />
        <br/>
        <select id="grp_id" name="grp_id" class="form-control centered shadow">
            <option>select group</option>
            @foreach ($list_grps as $list_grp)
                <option value="{{ $list_grp->id }}"{{ ($user->grp_id == $list_grp->id) ? 'selected' : '' }}>{{ $list_grp->name }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-success shadow">{{ __('mypage.mySave') }}</button>
        <a class="btn btn-danger pull-right shadow" href="/deleteuser/{{ $id }}"> {{ __('mypage.myDelete') }}</a>
    </form>
</div>
@endsection
<script type="text/javascript">
    function getUser(){
            var id = $("#usr_id option:selected").attr("value");

            console.log(id);
            
            $.ajax({
                url: '/updateuser/'+id,
                type: 'POST',
                dataType: "text",
                data: {id:id},
                success: function(result){
                    //alert(id);
                    // document.location.href='/tactic?id='+id;
                    document.location.href='/updateuser/'+id;
                },
                error: function(error) {
                    console.log('error:' + JSON.stringify(error));
                }
            });
        }
</script>