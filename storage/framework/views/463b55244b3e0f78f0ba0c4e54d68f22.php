
<?php $__env->startSection('content'); ?>
<div class="container"><br/><br/>
    <div class="row">
        <div class="col-3">
            <h4>Laravel прототип хостинг изображении</h4>
        </div>
        <div class="col-2 my-2">
            <a href="<?php echo e(route('images.create')); ?>" class="btn btn-success" title="Добавить новые изображении">
                Добавить
            </a>
        </div>

        <div class="col-2 my-2">
            <a href="<?php echo e(url('/download')); ?>" class="btn btn-primary" title="Скачать все">Скачать все</a>
        </div>

        <div class="col-3 my-2">
            <a href="<?php echo e(url('/images')); ?>?sort=name" class="btn btn-secondary">Сортировка имени</a>
        </div>

        <div class="col-2 my-2">
            <a href="<?php echo e(url('/images')); ?>?sort=date" class="btn btn-secondary">Сортировка дата</a>
        </div>
    </div>
    <?php if(session('message')): ?>
    <div class="alert alert-success" role="alert">
     <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>
    <table class="table table-bordered table-striped text-center" id="imagesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Название файла</th>
                <th>Дата и время</th>
                <th>Изображении</th>
                <th>Действие</th>
            </tr>    
        </thead>
        <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($item->filename); ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                    <td>
                       <a href="<?php echo e(asset('storage/images/'.$item->filename)); ?>"> <img src="<?php echo e(asset('storage/images/'. $item->filename)); ?>" width= '60' height='60' class="img img-responsive" /></a>
                    </td>
                    <td class="text-center">
                         <form action="<?php echo e(route('images.destroy', $item->id)); ?>" method="POST">
                            <?php echo method_field('DELETE'); ?>
                            <?php echo csrf_field(); ?>
                            <input type="submit" class="btn btn-danger mt-3" value="Удалить" />
                        </form>
                    </td>
                </tr>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Пустой</p> 
                <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\jumis\resources\views/index.blade.php ENDPATH**/ ?>