<div class="w-full p-8 bg-white rounded-xl">
    <div class="p-4 space-y-4 text-lg font-medium bg-white rounded shadow lg:p-6 lg">
        <p>Name: <span class="uppercase">{{ auth()->user()->name }}</span></p>
        <p>Email: <span class="lowercase">{{ auth()->user()->email }}</span></p>
        <p>Username: <span class="lowercase">{{ auth()->user()->username }}</span></p>
    </div>
    <form wire:submit.prevent='changeProfileImage' class="w-full">
        <div class="flex items-center py-4 space-x-4">
            <div class="relative">
                <input type="file" wire:model.defer="image" id="image" class="hidden">
                @if (auth()->user()->image && !$image)
                    <img src="{{ asset('/storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                        class="object-cover w-20 h-20 mt-2 border border-gray-200 rounded-full shadow-sm lg:h-24 lg:w-24 xl:h-28 xl:w-28">
                @elseif($image)
                    <img src="{{ $image->temporaryUrl() }}" alt="{{ auth()->user()->name }}"
                        class="object-cover w-20 h-20 mt-2 border border-gray-200 rounded-full shadow-sm lg:h-24 lg:w-24 xl:h-28 xl:w-28">
                @else
                    <img src="/img/avatar.png" alt="{{ auth()->user()->name }}"
                        class="object-cover w-20 h-20 mt-2 border border-gray-200 rounded-full shadow-sm lg:h-24 lg:w-24 xl:h-28 xl:w-28">
                @endif
            </div>
            <div class="flex flex-col">

                <div class="flex items-center w-full space-x-3 text-sm">
                    <label for="image"
                        class="inline-block px-3 py-2 font-medium capitalize align-middle bg-gray-200 rounded-full cursor-pointer max-w-max">change
                        image</label>
                    <button class="inline-block font-normal text-white rounded-lg btn tt bg-primary"
                        type="submit">Upload
                        Image</button>
                </div>
                <p class="pt-2 w-60">
                    @if ($errors->any())
                        @error('image')
                            <span class="w-24 text-sm leading-tight text-red-600"
                                style="line-height: 0px">{{ $message }}</span>
                        @enderror
                    @else
                        <span class="line max-w-[200px] leading-tight" style="line-height: 0px">Image allowed
                            png,jpeg,
                            jpg</span>
                    @endif
                </p>
            </div>
        </div>
    </form>
</div>
