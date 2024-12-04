<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <x-alert-dismissible :message="session('success')" />
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('role-create')
                        <x-create-button href="{{ route('roles.create') }}" class="mb-2">
                            <i class="fa-solid fa-plus me-2"></i>{{ __('Create Role') }}
                        </x-create-button>
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
                                        Guard name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Permissions
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
                                @forelse ($roles as $role)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $i++ }}
                                        </td>
                                        <td scope="col" class="px-6 py-4">
                                            {{ $role->name }}
                                        </td>
                                        <td scope="col" class="px-6 py-4">
                                            {{ $role->guard_name }}
                                        </td>
                                        <td scope="col" class="px-6 py-4">
                                            <div class="flex flex-wrap">
                                                @forelse ($role->permissions as $permission)
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 mt-1 mb-1 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $permission->name }}</span>
                                                @empty
                                                    <span class="text-gray-400">No permissions found</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td scope="col" class="flex gap-2 px-6 py-4">
                                            @can('role-show')
                                                <a href="{{ route('roles.show', $role->id) }}"
                                                    class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-cyan-500 text-white hover:bg-cyan-600 focus:ring-cyan-500 rounded-md">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('role-edit')
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-purple-500 text-white hover:bg-purple-600 focus:ring-purple-500 rounded-md">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('role-delete')
                                                <button x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion{{ $role->id }}')"
                                                    class="inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-red-500 text-white hover:bg-red-600 focus:ring-red-500 rounded-md">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>

                                                <x-modal name="confirm-deletion{{ $role->id }}" :show="false">
                                                    <form method="post" action="{{ route('roles.destroy', $role->id) }}"
                                                        class="p-6">
                                                        @csrf
                                                        @method('delete')

                                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                            {{ __('Are you sure you want to delete this role?') }}
                                                        </h2>

                                                        <div class="flex justify-end mt-6">
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Cancel') }}
                                                            </x-secondary-button>

                                                            <x-danger-button class="ms-3">
                                                                {{ __('Delete role') }}
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
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
