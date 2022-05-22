<?php  if (count($errors) > 0) : ?>
		<?php foreach ($errors as $error) : ?>
            <div class="alert alert-warning alert-dismissible fade show">
                <p><?php echo $error ?></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
		<?php endforeach ?>
<?php  endif ?>
