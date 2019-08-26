<?php $__env->startSection('title'); ?>
	Accueil
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

		<div id="main" class="col-md-12 col-lg-8 offset-lg-2">
			<h3>Bienvenue</h3>
			<h6>Voici la liste des livres disponibles</h6>
			<hr/>
			
			<form method="post" action="/my-books/search">
				<?php echo csrf_field(); ?>
			  	<div class="input-group col-10 offset-1">
					<input name="search" type="text" class="form-control inputText" placeholder="Recherche..." aria-label="Recherche" value="<?php echo e($search); ?>">
					<div class="input-group-append">
						<button id="searchBtn" class="btn btn-outline-secondary" type="submit">Rechercher</button>
				  	</div>
			  	</div>
		  	</form>
			<br/>
			<div id="books">
				<?php if(count($books) == 0): ?>
					<h4 class="text-center">Vous n'avez aucun livre d'emprunté.</h4>
				<?php endif; ?>

				<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a href='/books/<?php echo e($book->id); ?>' class="book col-sm-12 col-md-4 col-lg-3">
					<div class="image" style='background-image: url(<?php echo e($book->picture); ?>); background-size: cover;'></div>
					<p class="title"><?php echo e($book->title); ?></p>
					<p class="author"><?php echo e($book->author); ?></p>
				</a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			
			<hr/>
			
			<div id="nav">
				<?php if($page > 0): ?>
					<a href='/<?php echo e($previous); ?>' class="simple navBtn leftBtn"><i class="fa fa-chevron-left"></i>PRECEDENT</a>
				<?php endif; ?>

				<?php if($next != $page): ?>
					<a href='/<?php echo e($next); ?>' class="simple navBtn rightBtn">SUIVANT<i class="fa fa-chevron-right"></i></a>
				<?php endif; ?>
			</div>
		</div>
		
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yohann/code/library/resources/views/mybooks.blade.php ENDPATH**/ ?>