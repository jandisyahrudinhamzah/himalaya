
<button <?php echo e($attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white text-sm font-semibold uppercase tracking-wide rounded-xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:scale-[1.03] active:scale-[0.97] disabled:opacity-50 disabled:cursor-not-allowed'
])); ?>>
    <?php echo e($slot); ?>

</button><?php /**PATH C:\xampppp\htdocs\himalaya\resources\views/components/primary-button.blade.php ENDPATH**/ ?>