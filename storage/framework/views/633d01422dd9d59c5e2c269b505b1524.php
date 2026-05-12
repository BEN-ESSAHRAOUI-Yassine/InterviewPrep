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
        <div class="flex items-center gap-2">
            <a href="<?php echo e(route('dashboard')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('dashboard')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('dashboard')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Dashboard
            </a>
            <a href="<?php echo e(route('all-domains')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('all-domains')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('all-domains')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Domaines
            </a>
            <a href="<?php echo e(route('mes-domaines')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('mes-domaines')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('mes-domaines')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
                Mes domaines
            </a>
            <a href="#" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="background: #136f63; color: #b8d9d5; border: 1px solid rgba(255,255,255,0.1);">
                Archivés
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="px-6">
        <?php if(session('success')): ?>
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($domains->isEmpty()): ?>
            <div class="text-center py-16">
                <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                    <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">Aucun domaine</h3>
                <p class="text-[#b8d9d5] mb-6">Créez votre premier domaine pour organiser vos concepts</p>
                <a href="<?php echo e(route('domains.create')); ?>" class="inline-block px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Créer un domaine
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $domains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="relative rounded-xl p-6 border transition-all duration-200 hover:-translate-y-1" style="background: #136f63; border-color: rgba(255,255,255,0.08); box-shadow: 0 8px 32px rgba(0,0,0,0.25);">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full" style="background: <?php echo e(['blue' => '#3b82f6', 'green' => '#22c55e', 'red' => '#ef4444', 'purple' => '#a855f7', 'orange' => '#f97316', 'yellow' => '#eab308', 'pink' => '#ec4899', 'gray' => '#9ca3af'][$domain->color] ?? '#9ca3af'); ?>;"></span>
                            <a href="<?php echo e(route('domains.show', $domain)); ?>" class="text-white font-semibold text-lg hover:text-[#4ce0d2] transition-colors"><?php echo e($domain->name); ?></a>
                        </div>
                        <div class="relative">
                            <button onclick="toggleMenu<?php echo e($domain->id); ?>()" class="p-2 rounded-lg text-[#b8d9d5] hover:text-white hover:bg-[#0c2f28] transition-all duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                </svg>
                            </button>
                            <div id="menu-<?php echo e($domain->id); ?>" class="hidden absolute right-0 top-full mt-2 w-40 rounded-xl overflow-hidden z-10" style="background: #0c2f28; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 8px 32px rgba(0,0,0,0.4);">
                                <a href="<?php echo e(route('domains.edit', $domain)); ?>" class="flex items-center gap-2 px-4 py-3 text-sm text-white hover:bg-[#136f63] transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Modifier
                                </a>
                                <form method="POST" action="<?php echo e(route('domains.destroy', $domain)); ?>" onsubmit="return confirm('Supprimer ce domaine et tous ses concepts ?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="flex items-center gap-2 w-full px-4 py-3 text-sm text-[#ff7675] hover:bg-[#ff7675] hover:text-white transition-all duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm mb-4">
                        <span class="text-[#b8d9d5]"><?php echo e($domain->concepts_count); ?> concepts</span>
                        <span class="text-[#4ce0d2]"><?php echo e($domain->mastered_count); ?> maîtrisés</span>
                    </div>
                    <div class="w-full rounded-full h-2 mb-4" style="background: #0c2f28;">
                        <?php $percent = $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0; ?>
                        <div class="h-2 rounded-full transition-all duration-300" style="width: <?php echo e($percent); ?>%; background: #4ce0d2;"></div>
                    </div>
                    <a href="<?php echo e(route('domains.show', $domain)); ?>" class="inline-flex items-center gap-2 text-sm text-[#84cae7] hover:text-white transition-colors">
                        Voir les détails
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                <script>
                function toggleMenu<?php echo e($domain->id); ?>() {
                    document.querySelectorAll('[id^="menu-"]').forEach(m => { if (m.id !== 'menu-<?php echo e($domain->id); ?>') m.classList.add('hidden'); });
                    document.getElementById('menu-<?php echo e($domain->id); ?>').classList.toggle('hidden');
                }
                document.addEventListener('click', function(e) {
                    const btn = e.target.closest('button[onclick^="toggleMenu"]');
                    if (!btn && !e.target.closest('[id^="menu-"]')) {
                        document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
                    }
                });
                </script>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/domains/my.blade.php ENDPATH**/ ?>