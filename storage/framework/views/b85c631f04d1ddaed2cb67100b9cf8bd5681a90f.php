<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1><?php echo e($question->title); ?></h1>
                                <div class="ml-auto">
                                    <a href="<?php echo e(route('questions.index')); ?>" class="btn btn-outline-secondary">Back to all Questions</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">

                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">124</span>
                                <a title="This question is not useful">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="Click to mark as favourite question (Click again to undo)" class="favourite mt-2 favourited">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favourite-count">1234</span>
                                </a>
                            </div>

                            <div class="media-body">
                                <?php echo e($question->body); ?>

                                <div class="float-right mt-2">
                                    <span class="text-muted">Answered <?php echo e($question->created_date); ?></span>
                                    <div class="media mt-2">
                                        <a href="<?php echo e($question->user->url); ?>" class="pr-2">
                                            <img src="<?php echo e($question->user->avatar); ?>" alt="" style="width: 32px; height: 32px;">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="<?php echo e($question->user->url); ?>"><?php echo e($question->user->name); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">
                            <h2><?php echo e($question->answers_count . " ". \Illuminate\Support\Str::plural('Answer', $question->answers_count)); ?></h2>
                        </div>
                        <hr>
                        <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="media">

                                <div class="d-flex flex-column vote-controls">
                                    <a title="This answer is useful">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="votes-count">124</span>
                                    <a title="This answer is not useful">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                    <a title="Mark this answer as best answer" class="vote-accepted mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <?php echo e($answer->body); ?>

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
                            <hr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel-qa/resources/views/questions/show.blade.php ENDPATH**/ ?>