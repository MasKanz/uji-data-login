@extends('be.master')
@section('sidebar')
    @include('be.components.sidebar')
@endsection
@section('header')
    @include('be.components.header')
@endsection
@section('content')
<div class="container mt-5">
    <h2>Edit Status Kredit</h2>
    <form action="{{ route('kredit.update', $kredit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Status Kredit</label>
            <select name="status_kredit" class="form-control" required>
                <option value="Dicicil" {{ $kredit->status_kredit == 'Dicicil' ? 'selected' : '' }}>Dicicil</option>
                <option value="Lunas" {{ $kredit->status_kredit == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Macet" {{ $kredit->status_kredit == 'Macet' ? 'selected' : '' }}>Macet</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan_status_kredit" class="form-control" value="{{ $kredit->keterangan_status_kredit }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kredit.show', $kredit->id) }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection
