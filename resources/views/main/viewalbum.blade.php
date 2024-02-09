@extends('main.layout')
@section('content')
<div class="flex justify-center mt-2 mb-10">
    <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg md:flex-row md:max-w-xl dark:border-gray-700 dark:bg-gray-800">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <div class="row-auto flex justify-between">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $album->nama }}</h5>
                @if (Auth::user()->id === $album->user->id)

                <div data-popover id="popover-click" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-1">
                        <button type="button" data-modal-target="edit-modal-{{ $album->id }}" data-modal-toggle="edit-modal-{{ $album->id }}" class="w-8 h-8 rounded-full">
                            <i class="fa-solid fa-pen-to-square fa-lg hover:text-gray-700 dark:hover:text-gray-200"></i>
                        </button>
                        <button type="button" data-modal-target="delete-modal-{{ $album->id }}" data-modal-toggle="delete-modal-{{ $album->id }}" class="w-8 h-8 rounded-full">
                            <li class="fa fa-trash fa-lg hover:text-gray-700 dark:hover:text-gray-200"></li>
                        </button>
                    </div>
                    <div data-popper-arrow></div>
                </div>

                <div>
                    <button data-popover-target="popover-click" data-popover-trigger="click" type="button" class="rounded-full w-8 h-8 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <i class="fa-solid fa-ellipsis-vertical text-gray-600 dark:text-white"></i>
                    </button>
                </div>

                @endif
            </div>
            <div class="row-auto">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ $album->deskripsi }}
                </p>
            </div>
        </div>
    </div>
</div>
@if ($foto->count() < 1)
    <div class="mt-20 flex justify-center dark:text-white">
        Looks like this album doesn't have any images yet.
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

<!-- Edit Modal -->
<div id="edit-modal-{{ $album->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Edit Album
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-{{ $album->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <section class="bg-gray-100 dark:bg-gray-900 rounded-b-lg">
                <div class="py-8 px-8 mx-auto max-w-lg">
                    <form action="/edit-album-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <input type="hidden" name="id" id="id" value="{{ $album->id }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama album" value="{{ $album->nama }}" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea style="resize: none" name="deskripsi" id="deskripsi" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan deskripsi singkat tentang album" required>{{ $album->deskripsi }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Submit
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="delete-modal-{{ $album->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $album->id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <form action="/delete-album-user" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $album->id }}">
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete {{ $album->nama }}?</h3>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="delete-modal-{{ $album->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
