@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('kelas') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama kelas</th>
                                    <th>Nama Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($kelas as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->guru->nama_guru }}</td>
                                    {{-- <td>
                                        <img src="{{ asset('/storage/kelass/' . $data->image) }}" class="rounded"
                                            style="width: 150px">
                                    </td> --}}
                                    <td>
                                        <form action="{{ route('kelas.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <a href="{{ route('kelas.show', $data->id) }}"
                                                class="btn btn-sm btn-outline-dark">Show</a> | --}}
                                            <a href="{{ route('kelas.edit', $data->id) }}"
                                                class="btn btn-sm btn-success">Edit</a> |
                                            <button type="submit" onsubmit="return confirm('Are You Sure ?');"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Data data belum Tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- {!! $kelas->withQueryString()->links('pagination::bootstrap-4') !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
