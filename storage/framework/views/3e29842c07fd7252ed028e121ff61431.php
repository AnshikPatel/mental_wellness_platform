<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">My Test History</h1>
        <a href="<?php echo e(route('tests.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Tests
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Test</th>
                            <th>Date Taken</th>
                            <th>Score</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($result->test->title); ?></td>
                            <td><?php echo e($result->created_at->format('Y-m-d H:i:s')); ?></td>
                            <td><?php echo e($result->score); ?>%</td>
                            <td>
                                <span class="badge bg-<?php echo e($result->score >= 70 ? 'success' : 'danger'); ?>">
                                    <?php echo e($result->score >= 70 ? 'Passed' : 'Failed'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('test.results.show', $result)); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View Details
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No test results found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vikalpshakya/Desktop/laravel/project/resources/views/tests/results.blade.php ENDPATH**/ ?>