
<?php $__env->startSection('content'); ?>

<h5 class="my-3"><a href="<?php echo e(route('images.index')); ?>" class="text-decoration-none">Главная</a></h5>
<div class="card my-5">
  <div class="card-header">Добавить Новый</div>
  <div class="card-body">
      <form action="<?php echo e(route('images.store')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <input class="form-control" name="images[]" multiple type="file" id="photo"> </br>
        <input type="submit" value="Сохранить" class="btn btn-success"></br>
    </form>
  </div>
</div>
<?php if($errors->any()): ?>
    <div class="alert alert-danger"> 
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($error); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\jumis\resources\views/create.blade.php ENDPATH**/ ?>