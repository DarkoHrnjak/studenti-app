@extends('layout')

@section('content')

<table>
    <thead>
        <tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Status</th>
            <th>Godiste</th>
            <th>Prosjek</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $student)
        <tr>
            <td>{{ $student->ime }}</td>
            <td>{{ $student->prezime }}</td>
            <td>{{ $student->status }}</td>
            <td>{{ $student->godiste }}</td>
            <td>{{ $student->prosjek }}</td>
            <td>
                <a href="{{ route('students.edit', $student->id) }}" class="button">Edit</a>
                <form method="POST" action="{{ route('students.destroy', $student->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;">No students found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<a href="{{ route('students.create') }}" class="button add-new">Add New Student</a>

@endsection
