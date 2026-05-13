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
                <a href="<?php echo e(route('domains.show', $domain)); ?>" class="text-[#b8d9d5] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight"><?php echo e($domain->name); ?></h2>
                <span class="px-3 py-1 rounded-lg text-sm font-medium bg-<?php echo e($domain->color); ?>-100 text-<?php echo e($domain->color); ?>-800">
                    <?php echo e($domain->concepts_count); ?> concepts
                </span>
            </div>
            <a href="<?php echo e(route('domains.concepts.create', $domain)); ?>" class="px-5 py-2.5 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                + Nouveau concept
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="px-6">
        <?php if(session('success')): ?>
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="flex gap-2 mb-6">
            <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(!request('status')): ?> text-[#041b15] <?php endif; ?>" style="<?php if(!request('status')): ?> background: #22aaa1; <?php else: ?> color: #b8d9d5; <?php endif; ?>">
                Tous
            </a>
            <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>?status=to_review" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request('status') === 'to_review'): ?> text-[#041b15] <?php endif; ?>" style="<?php if(request('status') === 'to_review'): ?> background: #ff7675; <?php else: ?> color: #b8d9d5; <?php endif; ?>">
                À revoir
            </a>
            <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>?status=in_progress" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request('status') === 'in_progress'): ?> text-[#041b15] <?php endif; ?>" style="<?php if(request('status') === 'in_progress'): ?> background: #ffeaa7; <?php else: ?> color: #b8d9d5; <?php endif; ?>">
                En cours
            </a>
            <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>?status=mastered" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request('status') === 'mastered'): ?> text-[#041b15] <?php endif; ?>" style="<?php if(request('status') === 'mastered'): ?> background: #4ce0d2; <?php else: ?> color: #b8d9d5; <?php endif; ?>">
                Maîtrisés
            </a>
        </div>

        <?php if($concepts->isEmpty()): ?>
            <div class="text-center py-16">
                <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                    <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">Aucun concept</h3>
                <p class="text-[#b8d9d5] mb-6">Créez votre premier concept dans ce domaine</p>
                <a href="<?php echo e(route('domains.concepts.create', $domain)); ?>" class="inline-block px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Créer un concept
                </a>
            </div>
        <?php else: ?>
            <div class="rounded-xl overflow-hidden border" style="border-color: rgba(255,255,255,0.08);">
                <table class="w-full">
                    <thead style="background: #0d312a;">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Titre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Difficulté</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Statut</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-[#84cae7]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $concepts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t" style="border-color: rgba(255,255,255,0.08); background: #136f63;">
                            <td class="px-6 py-4">
                                <a href="<?php echo e(route('domains.concepts.show', [$domain, $concept])); ?>" class="text-white font-medium hover:text-[#4ce0d2] transition-colors">
                                    <?php echo e($concept->title); ?>

                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <?php $diffColors = ['junior' => 'bg-[#4ce0d2]/20 text-[#4ce0d2]', 'mid' => 'bg-[#84cae7]/20 text-[#84cae7]', 'senior' => 'bg-[#22aaa1]/20 text-[#22aaa1]']; ?>
                                <span class="px-3 py-1 rounded-lg text-sm font-medium <?php echo e($diffColors[$concept->difficulty] ?? 'bg-gray-100 text-gray-800'); ?>">
                                    <?php echo e($concept->difficultyLabel); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="<?php echo e(route('concepts.updateStatus', $concept)); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <select name="status" onchange="this.form.submit()" class="text-sm rounded-lg px-3 py-1 cursor-pointer outline-none" style="background: #0c2f28; border: 1px solid #136f63; color: white;">
                                        <option value="to_review" <?php if($concept->status === 'to_review'): echo 'selected'; endif; ?> class="bg-[#0c2f28]">À revoir</option>
                                        <option value="in_progress" <?php if($concept->status === 'in_progress'): echo 'selected'; endif; ?> class="bg-[#0c2f28]">En cours</option>
                                        <option value="mastered" <?php if($concept->status === 'mastered'): echo 'selected'; endif; ?> class="bg-[#0c2f28]">Maîtrisé</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="<?php echo e(route('domains.concepts.show', [$domain, $concept])); ?>" class="px-3 py-1.5 rounded-lg text-sm text-[#84cae7] hover:bg-[#84cae7] hover:text-[#041b15] transition-all duration-200">
                                        Voir
                                    </a>
                                    <a href="<?php echo e(route('domains.concepts.edit', [$domain, $concept])); ?>" class="px-3 py-1.5 rounded-lg text-sm text-[#4ce0d2] hover:bg-[#4ce0d2] hover:text-[#041b15] transition-all duration-200" style="border: 1px solid #4ce0d2;">
                                        Modifier
                                    </a>
                                    <form method="POST" action="<?php echo e(route('domains.concepts.destroy', [$domain, $concept])); ?>" class="inline" onsubmit="return confirm('Supprimer ce concept ?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-sm text-[#ff7675] hover:bg-[#ff7675] hover:text-white transition-all duration-200" style="border: 1px solid #ff7675;">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/concepts/index.blade.php ENDPATH**/ ?>