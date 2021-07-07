<?php
// load helper
require __DIR__ . DS . 'tools' . DS . 'helper.php';

isDirect();

function news_list_tpl($title, $path, $date, $summary) {
    ?>
    <div class="card shadow mb-3">
        <div class="card-body">
            <div class="content-date text-grey-dark"><i class="far fa-clock mr-2"></i><?php echo $date ?></div>
            <h3 class="content-title mb-4"><?php echo $title ?></h3>
            <p class="content-summary mb-2"><?php echo $summary ?>...</p>
            <div class="content-readmore flex justify-end"><a class="btn btn-info btn-small" href="<?php echo SWB.'index.php?p='.$path ?>"><?php echo __('Read More') ?></a></div>
        </div>
    </div>
    <?php
}