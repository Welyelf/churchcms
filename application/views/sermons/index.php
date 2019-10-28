<div class="find_wrapper">
    <div class="find_inner">
        <div class="find">
            <div class="txt1">welcome to</div>
            <div class="txt2"><?php echo $settings->site_name; ?></div>
            <div class="txt3"></div>
            <div class="line"></div>
            <div class="txt4">EVANGELICAL FREE CHURCH</div>
        </div>
    </div>
    <div id="slider_wrapper">
        <div id="slider">
            <img style="width:100%;height:100%" src="/assets/plugins/addins/images/1.jpg"/>
        </div>
    </div>
</div>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="find_wrapper">
                <div class="span9">
                    <div class="sermon-mode" <?php //echo $customizations->sermons_mode==0? 'style=display:none':''; ?>>
                        <h2><span>Latest Sermon</span></h2>    <br/>

                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    <?php
                                    foreach ($sermons as $sermon) {
                                        ?>
                                        <div class="item <?php if ($sermon === reset($sermons)) {
                                            echo "active";
                                        } ?>">
                                            <img src="https://img.youtube.com/vi/<?php echo $sermon->youtube_id; ?>/0.jpg"
                                                 alt="<?php echo $sermon->title; ?>" width="900px" height="500px">
                                            <div class="carousel-caption">
                                                <div class="caption" style="color:#ffffff;font-size:1.3em;">
                                                    <h5><?php echo $sermon->title; ?></h5>
                                                    <span><b>Pastor</b> : <i
                                                                style="margin-left:15px;"><?php echo $sermon->pastor; ?></i></span><br>
                                                    <span><b>Date</b>   : <i
                                                                style="margin-left:27px;"><?php echo date('F d, Y', $sermon->date); ?></i></span><br>
                                                    <span><b>Passage</b>: <i
                                                                style="margin-left:1px;"><?php echo $sermon->passage; ?></i></span>
                                                </div>
                                                <br><br><br><br>

                                                <div class="" style="margin-top:-10px;">
                                                    <a href="/sermons/<?php echo $sermon->slug; ?>">
                                                        <button class="btn btn-success btn-sm">VIEW SERMON</button>
                                                    </a>
                                                    <?php
                                                    if ($sermon->bulletin_link != NULL) {
                                                        ?>
                                                        <a href="<?php echo $sermon->bulletin_link; ?>" target="_blank">
                                                            <button class="btn btn-success btn-sm">VIEW BULLETIN
                                                            </button>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span style="font-size:0.7em;"> < </span>
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
                </div>
                <div class="span3" style="position:relative;z-index:10;">
                    <div class="donation-mode" <?php //echo $customizations->donation_mode==0? 'style=display:none':''; ?>>

                        <h2><span>Give Online</span></h2>
                        <div class="txt1">
                            <a href="/donations">
                                <button class="btn btn-success btn-sm">DONATE ONLINE</button>
                            </a>
                        </div>

                    </div>
                    <div class="service-mode" <?php //echo $customizations->service_mode==0? 'style=display:none':''; ?>>
                        <br/>
                        <h2><span>Service Time</span></h2>
                        <i style="font-size: 1.4em;">
                            <?php
                            foreach ($weekly_events as $event) { ?>
                                <?php
                                echo '- ' . get_12_hour($event->time) . ' - ' . $event->title; ?>
                                <br/>
                                <?php
                            }
                            ?>
                        </i>
                        <br/>
                    </div>
                    <div class="events-mode" <?php //echo $customizations->events_mode==0? 'style=display:none':''; ?>>

                        <h2><span>Upcoming Events</span></h2>

                        <?php foreach ($days as $day => $events) {
                            if ($events != null) {
                                ?>
                                <h5><?php echo date('l, F d, Y', $day); ?></h5>
                                <ul class="ul1" style="position:relative;z-index:100;">
                                    <?php
                                    foreach ($events as $event) {
                                        ?>
                                        <li>
                                            <a href="events">
                                                <?php echo get_12_hour($event->time) . ' - ' . $event->title; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

