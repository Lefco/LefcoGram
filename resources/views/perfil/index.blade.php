@extends('layouts.app')

@section('titulo')
Editar perfil: {{ auth()->user()->username}}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
        <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username
                </label>
                <input for="username" name="username" type="text" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500
                @enderror" value="{{ old('auth()->user()->username') }}" />
                @error('username')
                <p class="bg-red-500  text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen perfil
                </label>
                <input for="imagen" name="imagen" type="file" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg" value="" accept=".jpg, .jpeg, .png" />
            </div>
            <!--aquii para abajo -->

            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input id="email" name="email" type="email" placeholder="Tu Email de Registro" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ auth()->user()->email }}">
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">Antiguo Password</label>
                <input id="oldpassword" name="oldpassword" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500 @enderror">
                @error('oldpassword')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Nuevo Password</label>
                <input id="password" name="password" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Nueva Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg">
            </div>

            <!--termina aqui-->



            <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>


    </div>

</div>
@endsection