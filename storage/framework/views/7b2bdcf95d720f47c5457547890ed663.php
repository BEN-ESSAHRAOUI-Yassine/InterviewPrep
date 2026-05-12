<form method="post" action="<?php echo e(route('profile.destroy')); ?>" class="space-y-4">
    <?php echo csrf_field(); ?>
    <?php echo method_field('delete'); ?>

    <p class="text-[#b8d9d5] text-sm">
        Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
    </p>

    <div>
        <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Mot de passe</label>
        <input type="password" name="password" placeholder="Entrez votre mot de passe" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
        <?php $__errorArgs = ['password', 'userDeletion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-2 text-sm text-[#ff7675]"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <button type="submit" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #ff7675; color: white;" onmouseover="this.style.filter='brightness(1.1)'" onmouseout="this.style.filter='brightness(1)'">
        Supprimer le compte
    </button>
</form><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/profile/partials/delete-user-form.blade.php ENDPATH**/ ?>