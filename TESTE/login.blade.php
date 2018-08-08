@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 ">
            <div class="card card-default">
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('ent_cnpj') ? ' has-error' : '' }}">
                            <label for="ent_cnpj" class="col-md-4 control-label">CNPJ Entidade</label>

                            <div class="col-md-6">
                                <input id="ent_cnpj" type="ent_cnpj" class="form-control" name="ent_cnpj" value="{{ old('ent_cnpj') }}" required autofocus>

                                @if ($errors->has('ent_cnpj'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ent_cnpj') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usu_login') ? ' has-error' : '' }}">
                            <label for="usu_login" class="col-md-4 control-label">Usuário</label>

                            <div class="col-md-6">
                                <input id="usu_login" type="usu_login" class="form-control" name="usu_login" value="{{ old('usu_login') }}" required autofocus>

                                @if ($errors->has('usu_login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usu_login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mod_id') ? ' has-error' : '' }}">
                            <label for="mod_id" class="col-md-4 control-label">Módulo</label>
                            
                            <div class="col-md-6">
                                <select name="mod_id" id="mod_id" class="form-control">

                                    @foreach($modulos as $modulo)
                                        <option value="{{ $modulo->mod_id }}"> {{ $modulo->mod_descricao }} </option>
                                    @endforeach

                                </select>
                                

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usu_senha') ? ' has-error' : '' }}">
                            <label for="usu_senha" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="usu_senha" type="password" class="form-control" name="usu_senha" required>

                                @if ($errors->has('usu_senha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usu_senha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox hidden" >
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
