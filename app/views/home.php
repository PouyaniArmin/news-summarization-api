
<div class="container pt-4 py-4">
  <div class="row gy-4">
    <?php $i=0;foreach ($articles as $item):?>
      <div class="col-md-6 col-lg-6">
        <div class="card shadow-sm d-flex flex-column h-100">
          <?php if (isset($item['image'])): ?>
            <img src="<?php echo $item['image']; ?>" class="card-img-top" alt="News Image">
          <?php endif;?>
          <div class="card-body flex-grow-1">
            <h5 class="card-title">Title: <span class="text-muted"><?php echo $item['title'] ?></span></h5>
            <!-- Description Section -->
            <h6 class="mt-3">Description:</h6>
            <p class="card-text text-muted text-truncate"><?php echo $item['description']; ?></p>

            <!-- Content Section -->
            <h6 class="mt-3">Content:</h6>
            <p class="card-text text-muted text-truncate"><?php echo $item['content']; ?></p>
          </div>
          <div class="m-3">
            <!-- Buttons -->
            <a href="<?php echo $item['url'] ?>" class="btn btn-primary" target="_blank">Read More</a>
            <a href="/api/<?php echo $i; ?>" class="btn btn-primary" target="_blank">Summarize</a>
          </div>
        </div>
      </div>
    <?php $i++; endforeach ?>
  </div>
</div>