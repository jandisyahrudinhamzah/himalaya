<div style="text-align:center; margin-top:100px; color:white;">
    <h1>403</h1>
    <p>Oops! Kamu tidak punya akses ke halaman ini.</p>

    <div style="margin-top:20px;">
        <a href="/login">
            <button style="margin-right:10px;">Login Lagi</button>
        </a>

        @if(auth()->check())
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:red; color:white;">
                Logout
            </button>
        </form>
        @endif
    </div>
</div>