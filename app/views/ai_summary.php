<div class="container " style="min-height:500px;">
    <h2>AI Summary</h2>
    <?php if ($status===200) {?>
    <div>
        <p><?php echo $summary_text?></p>
    </div>
    <?php }else{?>
        <div>
            <h5>Erorr :<?php echo $status?></h5>
        </div>
    <?php }?>
</div>