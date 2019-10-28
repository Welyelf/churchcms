<?php
if (!isset($start) && $this->uri->segment(2) != "all"){
    ?>
    <div id="content">
        <div class="container">
            <div class="row">
                <h2>
                    <center><span>Browse</span></center>
                </h2>
                <a href="/sermons/all">
                    <button class="btn btn-success btn-sm ">View All Sermon</button>
                </a>
                <a href="/sermons/browse">
                    <button class="btn btn-success btn-sm ">Browse by Book</button>
                </a><br><br>
                <?php if (isset($sermons)) { // If a book is chosen from browse.
                    ?>
                    <table id="sermons-list" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="100%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sermons as $sermon) { ?>
                            <tr>
                                <td>
                                    <?php
                                    if (!isset($sermon_display) || $sermon_display == 'thumbnail') {
                                        ?>
                                        <div class="sermon-box">
                                            <a href="/sermons/view/<?php echo $sermon->slug; ?>">
                                                <div class="thumbnail sermon-hover"
                                                     style="font-size:1em;line-height:80%; ">
                                                    <?php if (empty($sermon->youtube_id) || $sermon->youtube_id == "#") { ?>
                                                        <div class="image">
                                                            <img src="/assets/img/no-vid4.png" alt=""
                                                                 style="width: 100%;"/>
                                                            <small class="image_passage">
                                                                <?php
                                                                $passages = $sermon->passages;
                                                                if ($passages) {
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
                                                                            if (next($passages)) {
                                                                                break;
                                                                            }

                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                            </small>
                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="https://img.youtube.com/vi/<?php echo $sermon->youtube_id; ?>/0.jpg"
                                                             alt="/assets/img/no-vid3.jpg" style="width: 100%;">
                                                    <?php } ?>
                                                    <div class="caption">
                                                        <p>
                                                            <b>
                                                                <i>
                                                                    <?php
                                                                    if ($sermon->title) {
                                                                        echo string_max_length($sermon->title, 36);
                                                                    }
                                                                    ?>
                                                                </i>
                                                            </b>
                                                        </p>
                                                        <p>
                                                            <i>
                                                                <?php
                                                                $passages = $sermon->passages;
                                                                if ($passages) {
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
                                                                            if (next($passages)) {
                                                                                echo ', ..... ';
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "<br>";
                                                                }

                                                                ?>
                                                            </i>
                                                        </p>
                                                        <p>
                                                            <?php if ($sermon->pastor) {
                                                                echo string_max_length($sermon->pastor, 36);
                                                            }
                                                            ?>
                                                        </p>

                                                        <p><i><?php echo date('F d, Y', $sermon->date); ?></i></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="sermon-box-card card" style="cursor: pointer;font-size:1.2em;">
                                            <a href="/sermons/view/<?php echo $sermon->slug; ?>">
                                                <div class="card-body">
                                                    <p>
                                                        <strong style="font-size: 1.2em;">
                                                            <?php
                                                            if ($sermon->title) {
                                                                echo string_max_length($sermon->title, 24);
                                                            }
                                                            ?>
                                                        </strong>
                                                    </p>
                                                    <p>
                                                        <strong style="font-size: 1em;">
                                                            <i>
                                                                <?php
                                                                $passages = $sermon->passages;
                                                                if ($passages) {
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
                                                                            if (next($passages)) {
                                                                                echo ', ..... ';
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </i>
                                                        </strong><br>
                                                        <span style="font-size: 1em;">
                                                                <i>
                                                                    <?php
                                                                    if ($sermon->pastor) {
                                                                        echo string_max_length($sermon->pastor, 36);
                                                                    }
                                                                    ?>
                                                                </i>
                                                            </span><br><br>
                                                        <small style="font-size: 1em;">
                                                            <i><?php echo date('F d, Y', $sermon->date); ?></i></small>
                                                        <br>

                                                    </p>
                                                </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php // endif sermons;
                } else { // Browse ?>

                <div class="row">
                    <?php foreach ($books as $key => $value) { ?>
                        <?php if ($value['count'] > 0) { ?>
                            <div class="span3">
                                <a href="<?php echo '/sermons/browse/' . get_book_slug($value['name']); ?>">
                                    <div class="box clearfix">
                                        <div class="box-header" style="margin-top: 5px;">
                                            <h4 class="box-title"><?php echo $value['name']; ?></h4>
                                            <div class="box-tools pull-right">
                                                <span style="width:20px;"
                                                      class="label <?php echo ($value['count']) ? 'label-success' : 'label-default'; ?>"><?php echo $value['count']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } // Endforeach;
                    } // Endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}else{
?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>
                    <center><span>Sermons</span></center>
                </h2>
                <?php if (!isset($sermons)) { ?>
                    <div class="span12">
                        <div class="alert alert-danger">No matching records found. <a href="/sermons"> Go Back.</a>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href="/sermons/all">
                        <button class="btn btn-success btn-sm ">View All Sermon</button>
                    </a>
                    <a href="/sermons/browse">
                        <button class="btn btn-success btn-sm ">Browse by Book</button>
                    </a>

                    <br><br>
                    <p><?php if (isset($start)) {
                            echo "Showing " . $start . ' - ' . $end; ?> of <?php echo $total;
                        } ?> </p>
                    <table id="sermons-list" class="table table-striped">
                        <thead>
                        <tr>
                            <th width="100%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sermons as $sermon) { ?>
                            <tr>
                                <td>
                                    <?php
                                    if (isset($sermon_display) && $sermon_display == 'thumbnail') {
                                        ?>
                                        <div class="sermon-box">
                                            <a href="/sermons/view/<?php echo $sermon->slug; ?>">
                                                <div class="thumbnail sermon-hover"
                                                     style="font-size:1em;line-height:80%; ">
                                                    <?php if (empty($sermon->youtube_id) || $sermon->youtube_id == "#") { ?>
                                                        <div class="image">
                                                            <img src="/assets/img/no-vid4.png" alt=""
                                                                 style="width: 100%;"/>
                                                            <small class="image_passage">
                                                                <?php
                                                                $passages = $sermon->passages;
                                                                if ($passages) {
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
                                                                            if (next($passages)) {
                                                                                break;
                                                                            }

                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "";
                                                                }

                                                                ?>
                                                            </small>

                                                        </div>
                                                    <?php } else { ?>
                                                        <img src="https://img.youtube.com/vi/<?php echo $sermon->youtube_id; ?>/0.jpg"
                                                             alt="/assets/img/no-vid3.jpg" style="width: 100%;">
                                                    <?php } ?>

                                                    <div class="caption">
                                                        <p>
                                                            <b>
                                                                <i>
                                                                    <?php
                                                                    if ($sermon->title) {
                                                                        echo string_max_length($sermon->title, 36);
                                                                    }
                                                                    ?>
                                                                </i>
                                                            </b>
                                                        </p>
                                                        <p>
                                                            <i>
                                                                <?php
                                                                $passages = $sermon->passages;
                                                                if ($passages) {
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
                                                                            if (next($passages)) {
                                                                                echo ', ..... ';
                                                                                break;
                                                                            }

                                                                        }
                                                                    }
                                                                } else {
                                                                    echo "<br>";
                                                                }

                                                                ?>
                                                            </i>
                                                        </p>
                                                        <p>
                                                            <?php
                                                            if ($sermon->pastor) {
                                                                echo string_max_length($sermon->pastor, 36);
                                                            }
                                                            ?>
                                                        </p>
                                                        <p><i><?php echo date('F d, Y', $sermon->date); ?></i></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    } else if ($sermon_display == 'box') {
                                        ?>
                                        <div class="sermon-box-card card" style="cursor: pointer;font-size:1.2em;">
                                            <a href="/sermons/view/<?php echo $sermon->slug; ?>">
                                                <div class="card-body">
                                                    <p>
                                                        <strong style="font-size: 1.2em;">
                                                            <?php
                                                            if ($sermon->title) {
                                                                echo string_max_length($sermon->title, 24);
                                                            }
                                                            ?>
                                                        </strong>
                                                    </p>
                                                    <p>
                                                        <strong style="font-size: 1em;">
                                                            <i>
                                                                <?php
                                                                $passages = $sermon->passages;
                                                                if ($passages) {
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
                                                                            if (next($passages)) {
                                                                                echo ', ..... ';
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                ?>
                                                            </i>
                                                        </strong><br>
                                                        <span style="font-size: 1em;">
                                                                        <i>
                                                                            <?php
                                                                            if ($sermon->pastor) {
                                                                                echo string_max_length($sermon->pastor, 36);
                                                                            }
                                                                            ?>
                                                                        </i>
                                                                    </span><br><br>
                                                        <small style="font-size: 1em;">
                                                            <i><?php echo date('F d, Y', $sermon->date); ?></i></small>
                                                        <br>

                                                    </p>
                                                </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">Sermon Display is not set.</div>
                                        <?php
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    }
    ?>




