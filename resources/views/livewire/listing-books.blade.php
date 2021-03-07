<div>

    <div class="p-6 sm:px-10 bg-white border-b border-gray-200">
        <div class="mt-8 text-2xl flex justify-between">
            <div>Toate cartile</div>
            <div class="mr-2">
                <x-jet-button class=" bg-blue-500 ml-2" wire:click="dialogBookAdd()" wire:loading.attr="disabled">
                    {{ __('Adauga carte') }}
                </x-jet-button>

            </div>
        </div>


    <div class="mt-6">
        <div class="flex justify-between">
            <div class="p-2">
                <x-jet-input wire:model="qbooks" class="block mt-1 w-full" type="search" placeholder="Cauta carte" name="phone" />
            </div>
            <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight" wire:model="active"> Doar disponibile
            </div>
        </div>
        <table class=" lg:mx-auto">
            <thead>
            <tr>
                <th class="px-6 py-2">
                    <div class="flex justify-center">
                        Titlu
                    </div>
                </th>
                <th class="px-6 py-2">
                    <div class="flex justify-center">
                        Autor
                    </div>
                </th>
                <th class="px-6 py-2">
                    <div class="flex justify-center">
                        Categorie
                    </div>
                </th>
                <th class="px-6 py-2">
                    <div class="flex justify-center">
                        An
                    </div>
                </th>
                <th class="px-6 py-2">
                    <div class="flex justify-center">
                        Disponibila
                    </div>
                </th>
                <th class="px-6 py-2">
                    <div class="flex justify-center">
                        ISBN
                    </div>
                </th>
                <th class="px-2 py-2">
                    <div class="flex justify-center">
                        Editura
                    </div>
                </th>
                <th class="px-6 py-2">
                    Actiuni
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td class="border px-15 py-2 ">{{$book->titlu}}</td>
                        <td class="border px-16 py-2">{{$book->autor}}</td>
                        <td class="border px-10 py-2">{{$book->categorie}}</td>
                        <td class="border px-4 py-2">{{$book->an}}</td>
                        <td class="border px-4 text-center py-2">{{$book->status }}</td>
                        <td class="border px-10 py-2">{{$book->isbn}}</td>
                        <td class="border px-10 py-2">{{$book->editura}}</td>
                        <td class="border px-20 py-2 inline-flex ">
                            Edit
                            <div>
                                <x-jet-danger-button class="mx-1" wire:click="confirmDeleteBook({{$book->id}})" wire:loading.attr="disabled">
                                    {{ __('Delete') }}
                                </x-jet-danger-button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>









    <div class="mt-4">
        {{$books->links()}}
    </div>
    <x-jet-dialog-modal wire:model="confirmBookDelete">
        <x-slot name="title">
            {{ __('Sterge Carte') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Sigur stergeti aceasta carte?') }}
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmBookDelete', false)" wire:loading.attr="disabled">
                {{ __('Anulare') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteBook({{$confirmBookDelete}})" wire:loading.attr="disabled">
                {{ __('Sterge cartea') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    <x-jet-dialog-modal wire:model="BookAdd" enctype="multipart/form-data">
        <x-slot name="title">
            {{ __('Adaugati o noua carte') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="titlu" value="{{ __('Titlu') }}" />
                <x-jet-input id="titlu" class="block mt-1 w-full" type="text" name="titlu" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="autor" value="{{ __('Autor') }}" />
                <x-jet-input id="autor" class="block mt-1 w-full" type="text" name="autor" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="categorie" value="{{ __('Categorie') }}" />
                <x-jet-input id="categorie" class="block mt-1 w-full" type="text" name="categorie" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="isbn" value="{{ __('ISBN') }}" />
                <x-jet-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" required  />
            </div>
            <div class="mt-4">
                <x-jet-label for="an" value="{{ __('An') }}" />
                <x-jet-input id="an" class="block mt-1 w-full" type="text" name="an" required  />
            </div>
            <div class="mt-4">
                <x-jet-label for="editura" value="{{ __('Editura') }}" />
                <x-jet-input id="editura" class="block mt-1 w-full" type="text" name="editura" required  />
            </div>
            <div class="mt-4">
                <x-jet-label for="descriere" value="{{ __('Descriere') }}" />
                <x-jet-input id="descriere" class="block mt-1 w-full" type="text" name="descriere" required  />
            </div>
            <div class="mt-4">
                <x-jet-label for="coperta" value="{{ __('Coperta') }}" />
                <x-jet-input id="coperta" class="block mt-1 w-full" type="file" wire:model="coperta"  name="coperta" required  />

            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('BookAdd', false)" wire:loading.attr="disabled">
                {{ __('Anulare') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2 bg-green-500 hover:bg-green-700" wire:click="addBook()" wire:loading.attr="disabled">
                {{ __('Adauga cartea') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>








<!-- Delete User Confirmation Modal

-->
