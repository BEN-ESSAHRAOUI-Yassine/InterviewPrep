<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>" class="text-[#b8d9d5] hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white leading-tight">Modifier le concept</h2>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-2xl mx-auto px-6">
        <form method="POST" action="<?php echo e(route('domains.concepts.update', [$domain, $concept])); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Titre du concept</label>
                <input type="text" name="title" value="<?php echo e(old('title', $concept->title)); ?>" required maxlength="200" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
                <?php $__errorArgs = ['title'];
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

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Explication</label>
                <textarea name="explanation" rows="8" required minlength="20" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200 resize-none" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'"><?php echo e(old('explanation', $concept->explanation)); ?></textarea>
                <?php $__errorArgs = ['explanation'];
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

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Difficulté</label>
                <div class="grid grid-cols-3 gap-3">
                    <?php $__currentLoopData = ['junior', 'mid', 'senior']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="cursor-pointer">
                        <input type="radio" name="difficulty" value="<?php echo e($diff); ?>" <?php if(old('difficulty', $concept->difficulty) === $diff): echo 'checked'; endif; ?> class="sr-only peer">
                        <?php $diffColors = ['junior' => ['bg' => 'bg-[#4ce0d2]/10', 'text' => 'text-[#4ce0d2]', 'ring' => 'ring-[#4ce0d2]'], 'mid' => ['bg' => 'bg-[#84cae7]/10', 'text' => 'text-[#84cae7]', 'ring' => 'ring-[#84cae7]'], 'senior' => ['bg' => 'bg-[#22aaa1]/10', 'text' => 'text-[#22aaa1]', 'ring' => 'ring-[#22aaa1]']]; ?>
                        <div class="px-4 py-3 rounded-xl text-center text-sm font-medium transition-all duration-200 peer-checked:ring-2 <?php echo e($diffColors[$diff]['ring']); ?> <?php echo e($diffColors[$diff]['bg']); ?> <?php echo e($diffColors[$diff]['text']); ?>" style="border: 1px solid currentColor;">
                            <?php echo e(ucfirst($diff)); ?>

                        </div>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['difficulty'];
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

            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Enregistrer
                </button>
                <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/concepts/edit.blade.php ENDPATH**/ ?>