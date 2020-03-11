<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>

                <form action="<?php echo e(route('questions.answers.store', $question->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <textarea name="body" id="" cols="30" rows="10" class="form-control <?php echo e($errors->has('body') ? 'is-invalid' : ''); ?>"></textarea>
                        <?php if($errors->has('body')): ?>
                            <div class="invalid-feedback">
                                <strong><?php echo e($errors->first('body')); ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/laravel-qa/resources/views/answers/_create.blade.php ENDPATH**/ ?>