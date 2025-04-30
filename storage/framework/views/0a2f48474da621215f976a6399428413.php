<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Book New Appointment</h1>
        <a href="<?php echo e(route('appointments.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Appointments
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('appointments.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="mb-3">
                    <label for="expert_id" class="form-label">Select Expert</label>
                    <select name="expert_id" id="expert_id" class="form-select" required>
                        <option value="">Choose an expert...</option>
                        <?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($expert->id); ?>"><?php echo e($expert->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="appointment_date" class="form-label">Appointment Date and Time</label>
                    <input type="datetime-local" name="appointment_date" id="appointment_date" 
                        value="<?php echo e(old('appointment_date')); ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Additional Notes</label>
                    <textarea name="notes" id="notes" rows="4" class="form-control"><?php echo e(old('notes')); ?></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-calendar-plus"></i> Book Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointment_date').min = today + 'T00:00';
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\anshi\OneDrive\Desktop\anshikdocuoffical\larvalpr\laravel\laravel\project\resources\views/appointments/create.blade.php ENDPATH**/ ?>