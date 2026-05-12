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

    <div class="py-8 px-6">
        <div class="max-w-7xl mx-auto space-y-8">
            <?php if($domains->isEmpty()): ?>
                <div class="text-center py-16">
                    <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                        <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Commencez votre préparation</h3>
                    <p class="text-[#b8d9d5] mb-6">Créez votre premier domaine pour suivre votre progression</p>
                    <a href="<?php echo e(route('domains.create')); ?>" class="inline-block px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                        Créer un domaine
                    </a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#84cae7] text-sm mb-2">Total Concepts</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($stats['total']); ?></p>
                    </div>
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#ff7675] text-sm mb-2">À revoir</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($stats['to_review']); ?></p>
                    </div>
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#ffeaa7] text-sm mb-2">En cours</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($stats['in_progress']); ?></p>
                    </div>
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#4ce0d2] text-sm mb-2">Maîtrisés</p>
                        <p class="text-3xl font-bold text-white"><?php echo e($stats['mastered']); ?></p>
                    </div>
                </div>

                <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-[#b8d9d5]">Progression globale</span>
                        <span class="text-white font-semibold"><?php echo e($stats['percent']); ?>%</span>
                    </div>
                    <div class="w-full rounded-full h-3" style="background: #0c2f28;">
                        <div class="h-3 rounded-full transition-all duration-300" style="width: <?php echo e($stats['percent']); ?>%; background: #4ce0d2;"></div>
                    </div>
                </div>

                <?php if($bestDomain || $worstDomain): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <?php if($bestDomain): ?>
                    <div class="rounded-xl p-6 border" style="background: #136f63; border-color: rgba(255,255,255,0.08);">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">🏆</span>
                            <span class="text-[#4ce0d2] font-semibold">Domaine le mieux maîtrisé</span>
                        </div>
                        <p class="text-white text-lg font-medium"><?php echo e($bestDomain->name); ?></p>
                        <p class="text-[#b8d9d5] text-sm"><?php echo e(round($bestDomain->mastered_count / $bestDomain->concepts_count * 100)); ?>% maîtrisé (<?php echo e($bestDomain->mastered_count); ?>/<?php echo e($bestDomain->concepts_count); ?>)</p>
                    </div>
                    <?php endif; ?>
                    <?php if($worstDomain && $worstDomain->to_review_count > 0): ?>
                    <div class="rounded-xl p-6 border" style="background: #136f63; border-color: rgba(255,255,255,0.08);">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">⚠️</span>
                            <span class="text-[#ff7675] font-semibold">Domaine prioritaire</span>
                        </div>
                        <p class="text-white text-lg font-medium"><?php echo e($worstDomain->name); ?></p>
                        <p class="text-[#b8d9d5] text-sm"><?php echo e($worstDomain->to_review_count); ?> concepts à revoir</p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div>
                    <h3 class="text-xl font-semibold text-white mb-4">Vos domaines</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <?php $__currentLoopData = $domains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('domains.show', $domain)); ?>" class="block rounded-xl p-6 border transition-all duration-200 hover:-translate-y-1" style="background: #136f63; border-color: rgba(255,255,255,0.08); box-shadow: 0 8px 32px rgba(0,0,0,0.25);">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="text-white font-semibold text-lg"><?php echo e($domain->name); ?></h4>
                                <span class="text-[#84cae7] text-sm"><?php echo e($domain->concepts_count); ?> concepts</span>
                            </div>
                            <div class="w-full rounded-full h-2 mb-3" style="background: #0c2f28;">
                                <?php $percent = $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0; ?>
                                <div class="h-2 rounded-full transition-all duration-300" style="width: <?php echo e($percent); ?>%; background: #4ce0d2;"></div>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#ff7675]"><?php echo e($domain->to_review_count); ?> à revoir</span>
                                <span class="text-[#4ce0d2]"><?php echo e($percent); ?>%</span>
                            </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/dashboard.blade.php ENDPATH**/ ?>