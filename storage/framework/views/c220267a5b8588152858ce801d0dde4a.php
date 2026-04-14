<div style="text-align:center; margin-top:100px; color:white;">
    <h1>403</h1>
    <p>Oops! Kamu tidak punya akses ke halaman ini.</p>

    <div style="margin-top:20px;">
        <a href="/login">
            <button style="margin-right:10px;">Login Lagi</button>
        </a>

        <?php if(auth()->check()): ?>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <button type="submit" style="background:red; color:white;">
                Logout
            </button>
        </form>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampppp\htdocs\himalaya\resources\views/errors/403.blade.php ENDPATH**/ ?>