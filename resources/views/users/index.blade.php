<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#fef8ec] py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded-3xl border border-[#feaf52] bg-[#fdf1cb] px-5 py-4 text-sm font-medium text-[#4a3824] shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 rounded-3xl border border-red-200 bg-[#fde8e2] px-5 py-4 text-sm font-medium text-[#8b1f11] shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-[32px] border border-[#feaf52] bg-gradient-to-b from-[#fdf1cb] to-[#fef8ec] shadow-[0_25px_70px_rgba(253,89,62,0.12)]">
                <div class="border-b border-[#fe914e]/30 bg-gradient-to-r from-[#fd593e] via-[#fe914e] to-[#feaf52] px-6 py-6 text-white">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.35em] text-white/90">Daftar Pengguna</p>
                            <h3 class="text-2xl font-semibold">Semua akun terdaftar</h3>
                        </div>
                        <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center rounded-full bg-[#fe941e] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#fd593e]">
                            Tambah User
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">No</th>
                                    <th class="border px-4 py-2 text-left">Nama</th>
                                    <th class="border px-4 py-2 text-left">Email</th>
                                    <th class="border px-4 py-2 text-left">Role</th>
                                    <th class="border px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $users->firstItem() + $key }}</td>
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">{{ $user->role }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border px-4 py-8 text-center text-sm text-slate-600">
                                            Belum ada data user.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
