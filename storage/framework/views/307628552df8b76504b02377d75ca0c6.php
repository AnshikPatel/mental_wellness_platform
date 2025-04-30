<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Test</h5>
                    <a href="<?php echo e(route('expert.tests.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Tests
                    </a>
                </div>

                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('expert.tests.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="title" class="form-label">Test Title</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="title" name="title" value="<?php echo e(old('title')); ?>" required>
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="description" name="description" rows="3" required><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Questions</label>
                            <div id="questions-container">
                                <div class="question-item card mb-3">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Question 1</label>
                                            <input type="text" class="form-control" name="questions[0][question]" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Options</label>
                                            <div class="options-container">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="questions[0][options][]" placeholder="Option 1" required>
                                                    <button type="button" class="btn btn-outline-danger remove-option">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="questions[0][options][]" placeholder="Option 2" required>
                                                    <button type="button" class="btn btn-outline-danger remove-option">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-outline-primary btn-sm add-option">
                                                <i class="fas fa-plus"></i> Add Option
                                            </button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Points</label>
                                            <input type="number" class="form-control" name="questions[0][points]" min="1" value="1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary" id="add-question">
                                <i class="fas fa-plus"></i> Add Question
                            </button>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Test
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionsContainer = document.getElementById('questions-container');
        const addQuestionBtn = document.getElementById('add-question');
        let questionCount = 1;

        // Add new question
        addQuestionBtn.addEventListener('click', function() {
            const questionHtml = `
                <div class="question-item card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Question ${questionCount + 1}</label>
                            <input type="text" class="form-control" name="questions[${questionCount}][question]" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Options</label>
                            <div class="options-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="questions[${questionCount}][options][]" placeholder="Option 1" required>
                                    <button type="button" class="btn btn-outline-danger remove-option">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="questions[${questionCount}][options][]" placeholder="Option 2" required>
                                    <button type="button" class="btn btn-outline-danger remove-option">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm add-option">
                                <i class="fas fa-plus"></i> Add Option
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Points</label>
                            <input type="number" class="form-control" name="questions[${questionCount}][points]" min="1" value="1" required>
                        </div>
                        <button type="button" class="btn btn-outline-danger btn-sm remove-question">
                            <i class="fas fa-trash"></i> Remove Question
                        </button>
                    </div>
                </div>
            `;
            questionsContainer.insertAdjacentHTML('beforeend', questionHtml);
            questionCount++;
        });

        // Remove question
        questionsContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-question')) {
                e.target.closest('.question-item').remove();
            }
        });

        // Add option
        questionsContainer.addEventListener('click', function(e) {
            if (e.target.closest('.add-option')) {
                const optionsContainer = e.target.closest('.options-container');
                const optionHtml = `
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="${optionsContainer.querySelector('input').name}" placeholder="New Option" required>
                        <button type="button" class="btn btn-outline-danger remove-option">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
            }
        });

        // Remove option
        questionsContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-option')) {
                const optionsContainer = e.target.closest('.options-container');
                if (optionsContainer.querySelectorAll('.input-group').length > 2) {
                    e.target.closest('.input-group').remove();
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vikalpshakya/Desktop/laravel/project/resources/views/expert/tests/create.blade.php ENDPATH**/ ?>