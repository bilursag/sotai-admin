<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('User Administration') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
          <a href="{{ route('admin.users.create') }}">Crear Usuario</a>
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-0">Nombre</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell dark:text-gray-100">Correo Electrónico</th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell dark:text-gray-100">RUT</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Rol</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
              @foreach ($users as $user)
                <tr>
                  <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium dark:text-gray-100 text-gray-900 sm:w-auto sm:max-w-none sm:pl-0">{{ $user->name }}</td>
                  <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $user->email }}</td>
                  <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $user->rut }}</td>
                  <td class="px-3 py-4 text-sm text-gray-500">{{ $user->getRoleNames()->join(', ') }}</td>
                  <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-gray-200 dark:hover:text-gray-400">Editar</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
