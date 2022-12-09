@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Kategori</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @php
                            $i =0;
                            @endphp
                            @forelse($categories as $category)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <form action="{{ route('category.destroy',Crypt::encrypt($category->id)) }}" method="POST">
                                        <a href="{{ route('category.edit',Crypt::encrypt($category->id)) }}" class="btn btn-warning btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection