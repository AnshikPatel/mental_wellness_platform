<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Appointment Details</h1>
        <div>
            <a href="<?php echo e(route('appointments.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Appointments
            </a>
            <?php if($appointment->status === 'pending' && auth()->id() === $appointment->user_id): ?>
                <form action="<?php echo e(route('appointments.destroy', $appointment)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                        <i class="fas fa-times"></i> Cancel Appointment
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="h4 mb-3">Appointment Information</h3>
                    <table class="table">
                        <tr>
                            <th>ID:</th>
                            <td><?php echo e($appointment->id); ?></td>
                        </tr>
                        <tr>
                            <th>Expert:</th>
                            <td><?php echo e($appointment->expert->name); ?></td>
                        </tr>
                        <tr>
                            <th>Date & Time:</th>
                            <td><?php echo e($appointment->appointment_date ? $appointment->appointment_date->format('Y-m-d H:i') : 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-<?php echo e($appointment->status === 'pending' ? 'warning' : ($appointment->status === 'approved' ? 'success' : 'danger')); ?>">
                                    <?php echo e(ucfirst($appointment->status)); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td><?php echo e($appointment->created_at->format('Y-m-d H:i:s')); ?></td>
                        </tr>
                        <tr>
                            <th>Last Updated:</th>
                            <td><?php echo e($appointment->updated_at->format('Y-m-d H:i:s')); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3 class="h4 mb-3">Notes</h3>
                    <?php if($appointment->notes): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Your Notes</h5>
                                <p class="card-text"><?php echo e($appointment->notes); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($appointment->expert_notes): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Expert's Notes</h5>
                                <p class="card-text"><?php echo e($appointment->expert_notes); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(auth()->user()->role === 'expert' && auth()->id() === $appointment->expert_id && $appointment->status === 'pending'): ?>
                <div class="mt-4">
                    <h3 class="h4 mb-3">Update Status</h3>
                    <form action="<?php echo e(route('appointments.update-status', $appointment)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expert_notes" class="form-label">Notes (Optional)</label>
                                    <textarea name="expert_notes" id="expert_notes" rows="3" class="form-control"><?php echo e(old('expert_notes', $appointment->expert_notes)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Status
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/vikalpshakya/Desktop/laravel/project/resources/views/appointments/show.blade.php ENDPATH**/ ?>