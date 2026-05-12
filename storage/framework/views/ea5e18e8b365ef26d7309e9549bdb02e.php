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
            <a href="<?php echo e(route('concepts.archived')); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 <?php if(request()->routeIs('concepts.archived')): ?> text-[#041b15] <?php else: ?> text-[#b8d9d5] <?php endif; ?>" <?php if(request()->routeIs('concepts.archived')): ?> style="background: #22aaa1;" <?php else: ?> style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" <?php endif; ?>>
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

        <?php if($concepts->isEmpty()): ?>
            <div class="text-center py-16">
                <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                    <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">Aucun concept archivé</h3>
                <p class="text-[#b8d9d5]">Les concepts supprimés apparaîtront ici.</p>
            </div>
        <?php else: ?>
            <div class="rounded-xl overflow-hidden border" style="border-color: rgba(255,255,255,0.08);">
                <table class="w-full">
                    <thead style="background: #0d312a;">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Titre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Domaine</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Difficulté</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Supprimé le</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-[#84cae7]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $concepts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t" style="border-color: rgba(255,255,255,0.08); background: #136f63;">
                            <td class="px-6 py-4 text-white font-medium"><?php echo e($concept->title); ?></td>
                            <td class="px-6 py-4 text-[#b8d9d5]"><?php echo e($concept->domain->name); ?></td>
                            <td class="px-6 py-4">
                                <?php $diffColors = ['junior' => 'bg-[#4ce0d2]/20 text-[#4ce0d2]', 'mid' => 'bg-[#84cae7]/20 text-[#84cae7]', 'senior' => 'bg-[#22aaa1]/20 text-[#22aaa1]']; ?>
                                <span class="px-3 py-1 rounded-lg text-sm font-medium <?php echo e($diffColors[$concept->difficulty] ?? ''); ?>">
                                    <?php echo e($concept->difficultyLabel); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-[#b8d9d5] text-sm"><?php echo e($concept->deleted_at->format('d/m/Y H:i')); ?></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <form method="POST" action="<?php echo e(route('concepts.restore', $concept)); ?>" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-sm text-[#4ce0d2] hover:bg-[#4ce0d2] hover:text-[#041b15] transition-all duration-200" style="border: 1px solid #4ce0d2;">
                                            Restaurer
                                        </button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('concepts.forceDelete', $concept)); ?>" class="inline" onsubmit="return confirm('Supprimer définitivement ?');">
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/concepts/archived.blade.php ENDPATH**/ ?>