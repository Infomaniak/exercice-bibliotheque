<?php $__env->startSection('title'); ?>
		<?php echo e($book->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

		<div id="main" class="col-md-12 col-lg-8 offset-lg-2">
			

		   	<?php if(count($errors) > 0): ?>
			    <div class="alert alert-danger">
			     Upload Validation Error<br><br>
			     <ul>
			      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			       <li><?php echo e($error); ?></li>
			      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			     </ul>
			    </div>
		   	<?php endif; ?>

		   	<?php if($message = Session::get('success')): ?>
			   <div class="alert alert-success alert-block">
			    <button type="button" class="close" data-dismiss="alert">×</button>
			           <strong><?php echo e($message); ?></strong>
			   </div>
			   <img src="/images/<?php echo e(Session::get('path')); ?>" width="300" />
		   	<?php endif; ?>

			<form method="post" action="/books/<?php echo e($book->id); ?>" enctype="multipart/form-data">
				<?php echo method_field('PATCH'); ?>
				<?php echo csrf_field(); ?>

				<input id="authorInput" name="author" type="text" class="form-control inputText" placeholder="Auteur" aria-label="Auteur" value='<?php echo e($book->author); ?>'/>
				<input id="titleInput" name="title" type="text" class="form-control inputText" placeholder="Titre" aria-label="Titre" value='<?php echo e($book->title); ?>'/>
				<hr/>


				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-3">

							       <input class="big-image" style="background-color: #DDD;" type="file" name="picture"  value='<?php echo e($book->picture); ?>'/>
					
							<hr/>
						</div>

						<div class="col-sm-12 col-md-8 col-lg-9">
							<h5>Synopsis</h5>

							<textarea id="synopsisInput" name="synopsis" class="form-control inputText" placeholder="Synopsis" aria-label="Synopsis"><?php echo e($book->synopsis); ?></textarea>
						</div>
					</div>
				</div>
			
				<hr/>

				<button type="submit" class="simple buttonLink">Modifier</button>	

		  	</form>
			<a href='/books/<?php echo e($book->id); ?>' class="simple buttonLink greyBtn">Retour</a>

			<hr/>

			<form method="post" action="/books/<?php echo e($book->id); ?>">
				<?php echo method_field('DELETE'); ?>
				<?php echo csrf_field(); ?>

				<button class="simple buttonLink">Supprimer</button>
			</form>
		</div>
		
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/yohann/code/library/resources/views/book/edit.blade.php ENDPATH**/ ?>