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
        <div class="flex items-center gap-2 mb-4">
            <a href="<?php echo e(route('dashboard')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('dashboard')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('dashboard')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Dashboard
            </a>
            <a href="<?php echo e(route('all-domains')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('all-domains')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('all-domains')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Domaines
            </a>
            <a href="<?php echo e(route('mes-domaines')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('mes-domaines')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('mes-domaines')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Mes domaines
            </a>
            <a href="<?php echo e(route('concepts.archived')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('concepts.archived')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('concepts.archived')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Archivés
            </a>
        </div>
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <h2 class="font-semibold text-xl text-white leading-tight"><?php echo e($domain->name); ?></h2>
                <span class="w-4 h-4 rounded-full" style="background: <?php echo e(['blue' => '#3b82f6', 'green' => '#22c55e', 'red' => '#ef4444', 'purple' => '#a855f7', 'orange' => '#f97316', 'yellow' => '#eab308', 'pink' => '#ec4899', 'gray' => '#9ca3af'][$domain->color] ?? '#9ca3af'); ?>;"></span>
            </div>
            <div class="flex gap-3">
                <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Voir les concepts
                </a>
                <a href="<?php echo e(route('domains.edit', $domain)); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Modifier
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="px-6">
        <?php if(session('success')): ?>
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="rounded-xl p-6 border mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
            <div class="grid grid-cols-3 gap-6 text-center">
                <div>
                    <p class="text-3xl font-bold text-white"><?php echo e($domain->concepts_count); ?></p>
                    <p class="text-[#b8d9d5] text-sm">Concepts</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-[#4ce0d2]"><?php echo e($domain->mastered_count); ?></p>
                    <p class="text-[#b8d9d5] text-sm">Maîtrisés</p>
                </div>
                <div>
                    <?php $percent = $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0; ?>
                    <p class="text-3xl font-bold text-[#4ce0d2]"><?php echo e($percent); ?>%</p>
                    <p class="text-[#b8d9d5] text-sm">Progression</p>
                </div>
            </div>
            <div class="mt-4 w-full rounded-full h-3" style="background: #0c2f28;">
                <div class="h-3 rounded-full transition-all duration-300" style="width: <?php echo e($percent); ?>%; background: #4ce0d2;"></div>
            </div>
        </div>

        <?php if($domain->concepts_count > 0): ?>
            <div class="mb-6">
                <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl font-medium transition-all duration-200" style="background: #136f63; color: #4ce0d2; border: 1px solid rgba(255,255,255,0.08);" onmouseover="this.style.background='#22aaa1'; this.style.color='#041b15'" onmouseout="this.style.background='#136f63'; this.style.color='#4ce0d2'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Voir les <?php echo e($domain->concepts_count); ?> concepts
                </a>
            </div>
        <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/domains/show.blade.php ENDPATH**/ ?>