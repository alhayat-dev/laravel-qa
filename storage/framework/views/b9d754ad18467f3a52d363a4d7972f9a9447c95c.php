<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h2><?php echo e($answersCount . " ". \Illuminate\Support\Str::plural('Answer', $answersCount)); ?></h2>
                </div>
                <hr>
                <?php echo $__env->make('layouts._messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="media">

                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count"><?php echo e($answer->question->votes_count); ?></span>
                            <a title="This answer is not useful">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accept', $answer)): ?>
                                <a title="Mark this answer as best answer"
                                   class="<?php echo e($answer->status); ?> mt-2"
                                   onclick="event.preventDefault(); document.getElementById('accept-answer-<?php echo e($answer->id); ?>').submit();">
                                    <i class="fas fa-check fa-2x"></i>

                                    <form action="<?php echo e(route('answers.accept', $answer->id)); ?>" method="POST" id="accept-answer-<?php echo e($answer->id); ?>" style="display: none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </a>
                            <?php else: ?>
                                <?php if($answer->is_best): ?>
                                    <a title="Mark this answer as best answer" class="<?php echo e($answer->status); ?> mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>

                        <div class="media-body">
                            <?php echo e($answer->body); ?>

                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $answer)): ?>
                                            <a href="<?php echo e(route('questions.answers.edit', [$question->id, $answer->id])); ?>" class="btn btn-sm btn-outline-info">Edit</a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $answer)): ?>
                                            <form class="form-delete" action="<?php echo e(route('questions.answers.destroy', [$question->id, $answer->id])); ?>" method="post">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <div class="float-right mt-2">
                                        <span class="text-muted">Answered <?php echo e($answer->created_date); ?></span>
                                        <div class="media mt-2">
                                            <a href="<?php echo e($answer->user->url); ?>" class="pr-2">
                                                <img src="<?php echo e($answer->user->avatar); ?>" alt="" style="width: 32px; height: 32px;">
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="<?php echo e($answer->user->url); ?>"><?php echo e($answer->user->name); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/laravel-qa/resources/views/answers/_index.blade.php ENDPATH**/ ?>