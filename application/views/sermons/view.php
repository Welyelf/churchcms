<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="inner"><br>
                        <?php
                        if (!empty($sermon->mp3_link) || !empty($sermon->youtube_id)) {
                            ?>
                            <div class="span12">
                                <div class="tabbable-panel">
                                    <div class="tabbable-line">
                                        <ul class="nav nav-tabs ">
                                            <?php
                                            if (!empty($sermon->youtube_id)) {
                                                ?>
                                                <li class="active">
                                                    <a href="#tab_default_1" data-toggle="tab">
                                                        VIDEO
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if (!empty($sermon->mp3_link)) {
                                                ?>
                                                <li <?php if (empty($sermon->youtube_id)) {
                                                    echo "class='active'";
                                                } ?> >
                                                    <a href="#tab_default_2" data-toggle="tab">
                                                        AUDIO
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_default_1">
                                                <?php
                                                if (!empty($sermon->youtube_id)) {
                                                    ?>
                                                    <div class="video-container">
                                                        <iframe width="853" height="480"
                                                                src="https://www.youtube.com/embed/<?php echo $sermon->youtube_id; ?>"
                                                                frameborder="0" allowfullscreen></iframe>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="tab-pane <?php if (empty($sermon->youtube_id)) {
                                                echo "active";
                                            } ?>" id="tab_default_2">
                                                <?php
                                                if (!empty($sermon->mp3_link)) {
                                                    ?>
                                                    <audio src="<?php echo $sermon->mp3_link; ?>" type=""
                                                           controls="controls" preload="none"
                                                           style="width: 100%;margin: 25px 0px;"/>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="span12">
                            <div class="span9" style="" id="view_sermon">
                                <?php if (!empty($sermon->transcript)) { ?>
                                    <a href="javascript:window.print()">
                                        <button style="cursor:pointer;" id="btn-print" type="button"
                                                class="btn btn-success">Print
                                        </button>
                                    </a>
                                    <hr>
                                <?php } ?>


                                <div class="col-md-8 text-center"
                                     style="font-family:'Frutiger';font-size:2em;line-height:150%;font-weight: normal">
                                    <strong style="font-size:1.1em;">
                                        <?php
                                        if ($sermon->title) {
                                            echo $sermon->title;
                                        }
                                        // else{
                                        //    echo "No Sermon Name";
                                        // }
                                        ?>
                                    </strong><br>

                                    <div class="col-md-4">
                                        <div class="col-md-6" style="font-size:0.8em;color:#444444;">
                                            <strong></strong>
                                            <?php
                                            if ($sermon->pastor) {
                                                echo $sermon->pastor;
                                            }
                                            //else{
                                            //    echo "No Pastor Name";
                                            //}
                                            ?>
                                        </div>
                                        <div class="col-md-6" style="font-size:0.8em;color:#444444;">
                                            <i>
                                                <?php

                                                // Update list of passages to use multiple scriptures table.
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
                                                            echo $script;
                                                        // Add comma for multiple scriptures.
                                                        if (next($passages))
                                                            echo ', ';
                                                    }
                                                //else
                                                //echo "No Passage";
                                                ?>
                                            </i>
                                        </div>
                                        <small style="color:#444444;font-size:0.6em;"><?php echo date('F d, Y', $sermon->date); ?></small>

                                        <br/><br/>
                                        <div class="col-md-12"
                                             style="text-align:left; text-justify: inter-word;margin-right:10px;margin-left:10px;color:#444444;font-size:0.8em;">
                                            <?php if (empty($sermon->transcript)) { ?>
                                                Transcript is not currently available.
                                                You can leave your email on the Request Transcript box and get notified when the transcript is available.
                                                <br/>
                                            <?php } else { ?>
                                                <?php echo html_entity_decode($sermon->transcript); ?>
                                            <?php } ?>

                                        </div>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                            <div id="printSermon"
                                 style="font-family:'Frutiger';display: none;text-align: justify;text-justify: inter-word;font-size: 20px;margin-right:5px;margin-left:5px;line-height: 150%;">
                                <p id="p_title">
                                    <strong><?php
                                        if ($sermon->title) {
                                            echo $sermon->title;
                                        }
                                        ?>
                                    </strong>
                                </p>
                                <p id="p_passage">
                                    <?php
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
                                                echo $script;
                                            // Add comma for multiple scriptures.
                                            if (next($passages))
                                                echo ', ';
                                        }
                                    ?>
                                </p>
                                <p id="p_date">
                                    <?php
                                    if ($sermon->pastor) {
                                        echo $sermon->pastor;
                                    }
                                    ?>
                                </p>

                                <p id="p_date">
                                    <?php
                                    echo date('F d, Y', $sermon->date);
                                    ?>
                                </p>
                                <p id="p_trans" style="font-size: 20px;">
                                    <?php if (empty($sermon->transcript)) { ?>
                                        Transcript is not currently available.
                                        You can leave your email below and get notified when the transcript is available.
                                        <br/>
                                    <?php } else { ?>
                                        <?php echo html_entity_decode($sermon->transcript); ?>
                                    <?php } ?>
                                </p>
                            </div>
                            <div class="span3"><br>
                                <?php
                                // Check if sermon attachments has data. Then display the data.
                                if ($sermon_attachments) {
                                    ?>
                                    <div class="well">
                                        <h2><span>ATTACHMENTS</span></h2>
                                        <small style="font-size:1em;">Downloadable Documents</small>
                                        <div id="list4">
                                            <ul>
                                                <?php if (!empty($sermon->transcript_link)) { ?>
                                                    <li><a href="<?php echo $sermon->transcript_link; ?>">
                                                            <strong>TRANSCRIPT</strong></a>
                                                    </li>
                                                <?php } else { ?>

                                                <?php } ?>

                                                <?php
                                                // Check if sermon attachments has data. Then display the data.
                                                if ($sermon_attachments) {
                                                    foreach ($sermon_attachments as $sermon_attachment) { ?>
                                                        <li>
                                                            <a href="<?php echo $sermon_attachment->file_url; ?>"
                                                               target="_blank">
                                                                <strong><?php if (isset($sermon_attachment->file_tag)) {
                                                                        echo $sermon_attachment->file_tag;
                                                                    } ?></strong>
                                                                - <?php echo $sermon_attachment->file_name; ?>
                                                            </a>
                                                        </li>
                                                    <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php
                                } ?>

                                <br>
                                <?php if (empty($sermon->transcript)) { ?>
                                    <div class="well">
                                        <h3>Request Transcript</h3>
                                        <form action="/sermons/request-transcript/" method="post">
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" id="client_email"
                                                       placeholder="Email Address"/>
                                                <input type="hidden" name="sermon_id"
                                                       value="<?php echo $sermon->id; ?>"/>
                                                <button class="btn btn-success" type="submit">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
