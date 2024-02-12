@extends('main.layout')
@section('content')
<div>
    <div class="flex justify-center">
        <div class="max-w-4xl h-auto w-full rounded-2xl mb-10">
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    @if ($foto)
                        <img class="rounded-2xl w-full shadow" src="{{ asset('foto/' . $foto->file) }}" alt="">
                    @else
                        <p>Post not found</p>
                    @endif
                </div>
                <div>
                    <div class="relative w-full max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                        <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="font-medium dark:text-white">
                                        <div>
                                            @if ($foto)
                                                {{ $foto->user->username }}
                                            @else
                                                not found
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            @if ($foto)
                                                {{ $foto->created_at->format('d M Y') }}
                                            @else
                                                not found
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->id === $foto->user->id)

                                <div data-popover id="popover-click" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div class="px-3 py-1">
                                        <button type="button" data-modal-target="edit-modal-{{ $foto->id }}" data-modal-toggle="edit-modal-{{ $foto->id }}" class="w-8 h-8 rounded-full">
                                            <i class="fa-solid fa-pen-to-square fa-lg hover:text-gray-700 dark:hover:text-gray-200"></i>
                                        </button>
                                        <button type="button" data-modal-target="delete-modal-{{ $foto->id }}" data-modal-toggle="delete-modal-{{ $foto->id }}" class="w-8 h-8 rounded-full">
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

                            <div class="p-4 md:p-5 space-y-4 border-b dark:border-gray-600 dark:text-white">
                                {{$foto->deskripsi}}
                            </div>
                            <div class="max-h-64 overflow-y-auto p-4 md:p-5 space-y-4">
                                @if ($komentar->isNotEmpty())
                                    @foreach ($komentar as $item)
                                        <div class="flex items-center gap-4">

                                            <div
                                                class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                                <svg class="absolute w-12 h-12 text-gray-400 -left-1"
                                                    fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>

                                            <div class="font-medium dark:text-white">
                                                <div>{{ $item->user->username }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $item->isi }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Handle the case where $komentar is null (no comments found) -->
                                    <p class="dark:text-white">No comments available</p>
                                @endif
                            </div>
                            <!-- Modal footer -->
                            <div class="border-t dark:border-gray-600">
                                <div class="flex pt-4 px-7 justify-between dark:text-white">
                                    <div>
                                        <h4 class="font-bold">{{ $komentar->count() }} Komentar</h4>
                                    </div>
                                    <div class="flex">
                                        @if ($like)
                                            <div class="mr-1">
                                                {{ $like->count() }}
                                            </div>
                                        @else
                                            not found
                                        @endif
                                        <form action="/like/{{$foto->id}}" method="post">
                                            @csrf
                                            <button class="text-xl" type="submit">
                                                <i id="heartIcon" class="@if ($isLiked) fa-solid fa-heart text-rose-500 @else fa-regular fa-heart @endif"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="/komentar" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="flex justify-between items-center p-4 md:p-5 border-gray-200 rounded-b dark:border-gray-600">
                                    <div>
                                        <input type="hidden" name="id" value="{{$foto->id}}">
                                        <input type="text" name="isi" id="isi" autocomplete="off"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-80 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500"
                                            placeholder="@error('content'){{ $message }}@enderror"
                                            autocomplete="false">
                                    </div>
                                    <div>
                                        <button type="submit" class="w-10 h-10 bg-gray-950 text-white rounded-full">
                                            <i class="fa-light fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-center my-12">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">You Might Also Like</h5>
    </div>
</div>
<div class="columns-2 gap-4 md:columns-3 lg:columns-6">
    @foreach ($random as $row)
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
<div id="edit-modal-{{ $foto->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Edit Foto
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-{{ $foto->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <section class="bg-gray-100 dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-2xl">
                    <form action="/edit-foto-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full sm:row-span-3">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div id="dropzone-text" class="hidden flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, or GIF (MAX. 800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" name="file" type="file" class="hidden"/>
                                        <div id="image-preview" class="w-full h-64 overflow-hidden">
                                            <!-- Image preview will be displayed here -->
                                            @if ($foto->file)
                                                <img src="{{ asset('foto/' . $foto->file) }}" class="w-full h-full object-cover rounded-lg" alt="Image Preview">
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="w-full">
                                <input type="hidden" name="id" id="id" value="{{ $foto->id }}">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                                <input type="text" value="{{ $foto->judul }}" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan judul foto" required>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album (Optional)</label>
                                <select name="album" id="album" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="{{ $foto->albumid }}">
                                        {{ $foto->album->nama ?? 'Not Selected' }}
                                    </option>
                                    @foreach ($album as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <textarea style="resize: none" name="deskripsi" id="deskripsi" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan deskripsi singkat tentang isi foto" required>{{ $foto->deskripsi }}</textarea>
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
<div id="delete-modal-{{ $foto->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal-{{ $foto->id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <form action="/delete-foto-user" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $foto->id }}">
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete {{ $foto->judul }}?</h3>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="delete-modal-{{ $foto->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropzone-file').addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const text = document.getElementById('dropzone-text');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Only image files are allowed.');
                return;
            }

            // Optionally, limit file size (in bytes)
            const maxSize = 5 * 1024 * 1024; // 5 MB
            if (file.size > maxSize) {
                alert('File size exceeds the maximum limit (5MB).');
                return;
            }

            reader.onload = function (e) {
                // Display image preview
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Image Preview">`;
                preview.classList.remove('hidden');
                text.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
