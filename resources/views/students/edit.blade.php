@extends('layout')

@section('content')
<form method="POST"
      action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}">
    @csrf
    @isset($student)
        @method('PUT')
    @endisset

    <input name="ime" placeholder="Ime" value="{{ $student->ime ?? '' }}"><br>
    <input name="prezime" placeholder="Prezime" value="{{ $student->prezime ?? '' }}"><br>

    <select name="status">
        <option value="redovni">Redovni</option>
        <option value="izvanredni">Izvanredni</option>
    </select><br>

    <input name="godiste" placeholder="Godište" value="{{ $student->godiste ?? '' }}"><br>
    <input name="prosjek" placeholder="Prosjek" value="{{ $student->prosjek ?? '' }}"><br>

    <button type="submit">Spremi</button>
</form>
@endsection
