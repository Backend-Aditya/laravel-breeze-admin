<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <x-alert-dismissible :message="session('success')" />
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('permission-create')
                        <a href="{{ route('permissions.create') }}"
                            class="mb-2 inline-flex items-center px-2.5 py-1.5 bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <i class="fa-solid fa-plus me-2"></i>{{ __('Create Permission') }}
                        </a>
                    @endcan
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($permissions as $permission)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $i++ }}
                                        </td>
                                        <td scope="col" class="px-6 py-4">
                                            {{ $permission->name }}
                                        </td>
                                        <td scope="col" class="flex gap-2 px-6 py-4">
                                            @can('permission-show')
                                                <a href="{{ route('permissions.show', $permission->id) }}"
                                                    class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-cyan-500 text-white hover:bg-cyan-600 focus:ring-cyan-500 rounded-md">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('permission-edit')
                                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                                    class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500 rounded-md">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('permission-delete')
                                                <button x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion{{ $permission->id }}')"
                                                    class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-red-500 text-white hover:bg-red-600 focus:ring-red-500 rounded-md">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>

                                                <x-modal name="confirm-deletion{{ $permission->id }}" :show="false">
                                                    <form method="post"
                                                        action="{{ route('permissions.destroy', $permission->id) }}"
                                                        class="p-6">
                                                        @csrf
                                                        @method('delete')

                                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                            {{ __('Are you sure you want to delete this permission?') }}
                                                        </h2>

                                                        <div class="flex justify-end mt-6">
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Cancel') }}
                                                            </x-secondary-button>

                                                            <x-danger-button class="ms-3">
                                                                {{ __('Delete permission') }}
                                                            </x-danger-button>
                                                        </div>
                                                    </form>
                                                </x-modal>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="col" class="px-6 py-4 text-center" colspan="5">No record found!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
