<div class="w-full p-8 bg-white rounded-xl">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 uppercase dark:text-gray-200">Books</h2>
            <button data-toggle="modal" data-target="#form" wire:click="add()"
                class="px-3 py-2 text-sm text-white bg-red-600 rounded hover:bg-red-500 focus:outline-none">Add
                Book</button>
        </div>
        <form action="">
            <input type="search" wire:model='search'
                class="p-2 text-sm placeholder-gray-400 border-2 border-green-600 rounded-md" placeholder="search book">
        </form>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="form" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="text-lg font-medium modal-title">
                        @if ($update)
                            Edit Book details
                        @else
                            Add new Book
                        @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form wire:submit.prevent=@if ($update) 'update' @else 'save' @endif
                        class="px-3 overflow-y-auto w-ful row h-96" enctype="multipart/form-data">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="w-full">
                                <label for="title" class="mb-1 text-sm font-normal text-gray-600">Title</label>
                                <input type="text" wire:model.defer="title"
                                    class="w-full p-2 font-medium placeholder-gray-400 border-2 rounded focus-within: focus:border-green-600 focus:outline-none">
                                @error('title')
                                    <span class="text-xs font-normal text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="author" class="mb-1 text-sm font-normal text-gray-600">Author</label>
                                <input type="text" wire:model.defer="author"
                                    class="w-full p-2 font-medium placeholder-gray-400 border-2 rounded focus-within: focus:border-green-600 focus:outline-none">
                                @error('author')
                                    <span class="text-xs font-normal text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="w-full">
                                <label for="author"
                                    class="mb-1 text-sm font-normal text-gray-600 capitalize">Publishes date</label>
                                <input type="year" wire:model.defer="publication_year"
                                    class="w-full p-2 font-medium placeholder-gray-400 border-2 rounded focus-within: focus:border-green-600 focus:outline-none">
                                @error('publication_year')
                                    <span class="text-xs font-normal text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="flex justify-end my-auto text-right lg:col-span-2">
                            @if ($update)
                                <button type="submit"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-green-600 border-2 border-green-500 rounded hover:opacity-80">Update
                                    Book</button>
                            @else
                                <button type="submit"
                                    class="px-3 py-2 text-sm font-medium text-center text-white bg-green-600 border-2 border-green-500 rounded hover:opacity-80">Save
                                    Book</button>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
          </div> --}}

            </div>
        </div>
    </div>
    @if ($books->count() > 0)
        <table class="w-full overflow-hidden border border-collapse border-white rounded shadow table-auto">
            <thead>
                <tr class="font-normal text-left text-white bg-green-600 border px-">
                    <th class="py-2 pl-2 font-normal">No</th>
                    <th class="py-2 pl-2 font-normal"> Title</th>
                    <th class="py-2 pl-2 font-normal">Author</th>
                    <th class="py-2 pl-2 font-normal">Published Year</th>
                    <th class="py-2 pl-2 font-normal">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr class="border">
                        <td class="p-2">{{ $loop->iteration }}</td>
                        <td class="p-2">
                            <div class="space-y-2">
                                <p class="font-semibold uppercase">{{ $book->title }}</p>
                            </div>
                        </td>
                        <td class="p-2 uppercase">
                            {{ $book->author }}
                        </td>
                        <td class="p-2">{{ $book->publication_year }}</td>
                        <td class="items-center justify-start p-2">
                            <button wire:click='edit({{ $book->id }})' title="Edit Book" data-toggle="tooltip"
                                data-placement="left"
                                class="p-1 mx-1 text-white transition duration-500 bg-blue-600 rounded-sm hover:opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            <button wire:click="confirmDelete({{ $book->id }})" title="Delete Book"
                                data-toggle="tooltip" data-placement="top"
                                class="p-1 mx-1 text-white transition duration-500 bg-red-600 rounded-sm hover:opacity-80">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <h2>No books yet in the shelf</h2>
                @endforelse

                <div class="py-2">
                    <p class="py-2 my-2">{{ $books->links() }}</p>
                </div>

            </tbody>
        </table>
    @else
        <p class="text-lg">No book, kindly add books</p>
    @endif
</div>
