@extends('main.layout')
@section('content')
<div>
    @if ($foto->count() < 1)
        <div class="mt-10 flex justify-center dark:text-white">
            Oops! The image you're looking for couldn't be found.
        </div>
    @endif
    <div class="columns-2 gap-4 md:columns-3 lg:columns-6">
        @foreach ($foto as $row)
        <div class="relative group">
            <a href="/view-foto/{{$row->id}}" class="block relative">
                <img class="mb-4 shadow h-auto max-w-full rounded-lg transition-transform transform-gpu hover:scale-110" src="{{ asset('foto/' . $row->file) }}" alt="">
                <div class="absolute inset-0 bg-black opacity-0 transition-opacity group-hover:opacity-50 flex items-center justify-center rounded-lg">
                    <i class="text-white fas fa-search fa-2x mr-1"></i>
                    <div class="text-white">{{$row->judul}}</div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
