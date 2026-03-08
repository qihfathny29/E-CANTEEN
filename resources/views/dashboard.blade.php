<x-app-layout>
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>
    <div style="padding: 1.5rem 2rem;">
        <div class="panel" style="padding: 2rem;">
            <p style="font-family: var(--font-b); color: var(--text-sub);">Kamu sudah login. Silakan navigasi ke menu yang tersedia.</p>
        </div>
    </div>
</x-app-layout>
