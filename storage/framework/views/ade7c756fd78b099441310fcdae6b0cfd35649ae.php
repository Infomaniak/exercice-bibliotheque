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

					<div class="col-sm-12 col-md-4" style="border-right: 1px solid #DDD;">
						<div class="big-image" style='background-image: url(<?php echo e($book->picture); ?>);'></div>
						<hr/>

						<?php if(Auth::check()): ?>
							<?php if($book->borrower == NULL && Auth::user()->librarian): ?>
								<p style="font-style: italic; text-align: center;">Actuellement disponible</p>
							<?php elseif($book->borrower == NULL): ?>
								<form method="POST" action="/books/<?php echo e($book->id); ?>">
									<?php echo csrf_field(); ?>

									<button type="submit" class="simple buttonLink">Reserver</button>
								</form>
							<?php elseif(Auth::user()->name == $book->borrower): ?>
								<form method="POST" action="/books/<?php echo e($book->id); ?>">
									<?php echo csrf_field(); ?>

									<button type="submit" class="simple buttonLink">Rendre</button>
								</form>
							<?php else: ?>
								<p style="font-style: italic; text-align: center;">Actuellement emprunté par <?php echo e($book->borrower); ?></p>
							<?php endif; ?>

							<?php if(Auth::user()->librarian): ?>
								<a href='/books/<?php echo e($book->id); ?>/edit' class="simple buttonLink">Éditer</a>
							<?php endif; ?>
						<?php else: ?>
							<p style="font-style: italic; text-align: center;">Vous devez être connecté pour emprunter un livre.</p>
						<?php endif; ?>
					</div>


					<div class="col-sm-12 col-md-8">
						<h5>Synopsis</h5>
						<p><?php echo e($book->synopsis); ?></p>
					</div>
				</div>
			</div>
			
			<hr/>
			
			<div id="nav">
				<?php if($previous != $book->id): ?>
					<a href='/books/<?php echo e($previous); ?>' class="simple navBtn leftBtn"><i class="fa fa-chevron-left"></i>LIVRE PRECEDENT</a>
				<?php endif; ?>

				<?php if($next != $book->id): ?>
					<a href='/books/<?php echo e($next); ?>' class="simple navBtn rightBtn">LIVRE SUIVANT<i class="fa fa-chevron-right"></i></a>
				<?php endif; ?>
			</div>
		</div>
		
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yohann/code/library/resources/views/book/display.blade.php ENDPATH**/ ?>