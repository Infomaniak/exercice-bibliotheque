<?php $__env->startSection('title'); ?>
		<?php echo e($book->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

		<div id="main" class="col-md-12 col-lg-8 offset-lg-2">
			<h6><?php echo e($book->author); ?></h6>
			<h3><?php echo e($book->title); ?></h3>
			<hr/>

			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-3">
						<div class="big-image" style='background-image: url(<?php echo e($book->picture); ?>); background-size: cover;'></div>
						<hr/>
						<button id="borrow">Reserver</button>
					</div>

					<div class="col-sm-12 col-md-8 col-lg-9">
						<h5>Synopsis</h5>
						<p><?php echo e($book->synopsis); ?></p>
					</div>
				</div>
			</div>
			
			<hr/>
			
			<div id="nav">
				<?php if($previous != $book->id): ?>
					<a href='/books/<?php echo e($previous); ?>' class="simple leftBtn"><i class="fa fa-chevron-left"></i>LIVRE PRECEDENT</a>
				<?php endif; ?>

				<?php if($next != $book->id): ?>
					<a href='/books/<?php echo e($next); ?>' class="simple rightBtn">LIVRE SUIVANT<i class="fa fa-chevron-right"></i></a>
				<?php endif; ?>
			</div>
		</div>
		
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yohann/code/library/resources/views/book/book.blade.php ENDPATH**/ ?>