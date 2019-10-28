<?php
if (isset($location)) {
    if ($location == 'content') {

        ?>
        <div class="sermon-mode">
            <h2><span>Latest Sermon</span></h2>    <br/>
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousels">
                    <div class="carousel-inner">
                        <?php
                        foreach ($sermons as $sermon) {
                            ?>
                            <div class="item <?php if ($sermon === reset($sermons)) {
                                echo "active";
                            } ?>">
                                <a href="/sermons/<?php echo $sermon->slug; ?>">
                                    <img src="https://img.youtube.com/vi/<?php echo $sermon->youtube_id; ?>/maxresdefault.jpg"
                                         alt="<?php echo $sermon->title; ?>" width="900px" height="500px">
                                    <div class="carousel-caption">

                                        <div class="caption" style="color:#ffffff;font-size:1.3em;">
                                            <h4>
                                                <?php
                                                if ($sermon->title) {
                                                    echo string_max_length($sermon->title, 50);
                                                }
                                                //else{
                                                //  echo "No Sermon Name";
                                                //}
                                                ?>
                                            </h4>
                                            <span><b>Pastor</b> : <i style="margin-left:15px;">
                                                    <?php
                                                    if ($sermon->pastor) {
                                                        echo string_max_length($sermon->pastor, 36);
                                                    }
                                                    ///else{
                                                    //    echo "No Pastor Name";
                                                    //}
                                                    ?>
                                                </i></span><br>
                                            <span><b>Date</b>   : <i
                                                        style="margin-left:27px;"><?php echo date('F d, Y', $sermon->date); ?></i></span><br>
                                            <span><b>Passage</b>:
                                                    <i style="margin-left:15px;">
                                                         <?php
                                                         $passages = $sermon->passages;
                                                         if ($passages)
                                                             foreach ($passages as $passage) {
                                                                 $scripture = array(
                                                                     $passage->book_id,
                                                                     $passage->chapter_from,
                                                                     $passage->verse_from,
                                                                     $passage->chapter_to,
                                                                     $passage->verse_to
                                                                 );
                                                                 $script = get_scripture_label($scripture);

                                                                 if ($script)
                                                                     echo string_max_length($script, 32);
                                                                 // Add comma for multiple scriptures.
                                                                 if (next($passages))
                                                                     echo ', ';
                                                             }
                                                         //else
                                                         //    echo "No Passage";
                                                         ?>

                                                        </i>
                                                </span>

                                        </div>
                                        <br><br>

                                        <div class="" style="margin-top:-10px;">
                                            <a href="/sermons/<?php echo $sermon->slug; ?>">
                                                <button class="btn btn-success btn-sm">VIEW SERMON</button>
                                            </a>
                                            <?php
                                            if ($sermon->bulletin_link != NULL) {
                                                ?>
                                                <a href="<?php echo $sermon->bulletin_link; ?>" target="_blank">
                                                    <button class="btn btn-success btn-sm">VIEW BULLETIN</button>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span style="font-size:0.7em;">  </span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span style="font-size:0.7em;"> > </span>
                    </a>
                </div>
                <div class="main-text hidden-xs">
                    <div class="col-md-12 text-center">
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {
        ?>
        <h2>
            <center><span>Latest Sermon</span></center>
        </h2>

        <?php
        foreach ($sermons as $sermon) {
            ?>
            <div class="card" onclick="location.href='/sermons/<?php echo $sermon->slug; ?>';" style="cursor: pointer;">
                <div class="card-body">

                    <?php
                    if (isset($show_image)) {
                        if (strcasecmp($show_image, 'true') == 0) {
                            ?>
                            <img src="https://img.youtube.com/vi/<?php echo $sermon->youtube_id; ?>/maxresdefault.jpg"
                                 alt="<?php echo $sermon->title; ?>" width="900px" height="500px">
                            <?php
                        }
                    }
                    ?>
                    <p>
                        <strong>
                            <?php
                            if ($sermon->title) {
                                echo string_max_length($sermon->title, 50);
                            }
                            ?>
                        </strong>
                    </p>
                    <p>
                        <span> <i><?php echo date('F d, Y', $sermon->date); ?></i></span><br>
                        <span>
                                            <i>
                                                        <?php
                                                        if ($sermon->pastor) {
                                                            echo string_max_length($sermon->pastor, 36);
                                                        }
                                                        ?>
                                            </i>
                                        </span><br>
                        <span>
                                             <i>
                                                 <?php
                                                 $passages = $sermon->passages;
                                                 if ($passages)
                                                     foreach ($passages as $passage) {
                                                         $scripture = array(
                                                             $passage->book_id,
                                                             $passage->chapter_from,
                                                             $passage->verse_from,
                                                             $passage->chapter_to,
                                                             $passage->verse_to
                                                         );
                                                         $script = get_scripture_label($scripture);
                                                         if ($script) {
                                                             echo string_max_length($script, 32);
                                                             // Add comma for multiple scriptures.
                                                             //if (next($passages))
                                                             //   echo ', ';
                                                             break;
                                                         }
                                                     }
                                                 ?>
                                                </i>
                                         </span>
                    </p>
                </div>

            </div>
            <?php
        }
        ?>
        <?php
    }
}

?>


<style>
    .card {
        margin-top: 5px;
        padding-bottom: 5px;
    }

</style>