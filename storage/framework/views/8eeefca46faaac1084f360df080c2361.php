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
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('domains.concepts.index', $domain)); ?>" class="text-[#b8d9d5] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight"><?php echo e($concept->title); ?></h2>
                <?php $diffColors = ['junior' => 'bg-[#4ce0d2]/20 text-[#4ce0d2]', 'mid' => 'bg-[#84cae7]/20 text-[#84cae7]', 'senior' => 'bg-[#22aaa1]/20 text-[#22aaa1]']; ?>
                <span class="px-3 py-1 rounded-lg text-sm font-medium <?php echo e($diffColors[$concept->difficulty] ?? ''); ?>">
                    <?php echo e($concept->difficultyLabel); ?>

                </span>
            </div>
            <div class="flex gap-3">
                <a href="<?php echo e(route('domains.concepts.edit', [$domain, $concept])); ?>" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Modifier
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="px-6 space-y-6">
        <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
            <div class="flex items-center gap-4 mb-4">
                <span class="px-4 py-2 rounded-xl text-sm font-medium <?php if($concept->status === 'to_review'): ?> bg-[#ff7675]/20 text-[#ff7675] <?php elseif($concept->status === 'in_progress'): ?> bg-[#ffeaa7]/20 text-[#ffeaa7] <?php else: ?> bg-[#4ce0d2]/20 text-[#4ce0d2] <?php endif; ?>">
                    <?php echo e($concept->statusLabel); ?>

                </span>
                <form method="POST" action="<?php echo e(route('concepts.updateStatus', $concept)); ?>" class="flex items-center gap-2">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <select name="status" onchange="this.form.submit()" class="text-sm rounded-lg px-3 py-2 cursor-pointer outline-none" style="background: #0c2f28; border: 1px solid #136f63; color: white;">
                        <option value="to_review" <?php if($concept->status === 'to_review'): echo 'selected'; endif; ?>>À revoir</option>
                        <option value="in_progress" <?php if($concept->status === 'in_progress'): echo 'selected'; endif; ?>>En cours</option>
                        <option value="mastered" <?php if($concept->status === 'mastered'): echo 'selected'; endif; ?>>Maîtrisé</option>
                    </select>
                </form>
            </div>

            <h3 class="text-lg font-semibold text-white mb-3">Explication</h3>
            <div class="prose prose-invert max-w-none text-[#b8d9d5] whitespace-pre-wrap"><?php echo e($concept->explanation); ?></div>
        </div>

        <div class="rounded-xl p-6 border" style="background: #136f63; border-color: rgba(255,255,255,0.08);">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Questions générées</h3>
                <form action="<?php echo e(route('questions.store', [$domain, $concept])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 flex items-center gap-2" style="background: linear-gradient(135deg, #136f63, #22aaa1); color: #041b15;" onmouseover="this.style.filter='brightness(1.08)'" onmouseout="this.style.filter='brightness(1)'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Générer des questions
                    </button>
                </form>
            </div>
            <?php if($concept->generatedQuestions->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $concept->generatedQuestions()->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $generation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rounded-lg p-4" style="background: rgba(0,0,0,0.2);">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-[#b8d9d5]">
                                    Génération du <?php echo e($generation->created_at->format('d/m/Y à H:i')); ?>

                                </span>
                                <form action="<?php echo e(route('questions.destroy', $generation)); ?>" method="POST" onsubmit="return confirm('Supprimer ce lot de questions ?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-[#ff7675] hover:text-[#ff7675]/80 text-sm font-medium">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                            <ol class="list-decimal list-inside space-y-1">
                                <?php $__currentLoopData = $generation->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="text-white text-sm"><?php echo e($question); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-[#b8d9d5] text-sm">Les questions d'entretien pour ce concept apparaîtront ici.</p>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\interviewprep\resources\views/concepts/show.blade.php ENDPATH**/ ?>