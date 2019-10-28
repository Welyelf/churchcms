<div id="content">
    <div class="container">
        <div class="row">
            <h2>
                <center><span>Sitemap</span></center>
            </h2>
            <div class="span4">
                <div class="tree">
                    <ul>
                        <li>
                            <span>
                                <a style="color:#000;">
                                <i class="expanded"><i class="far fa-folder-open"></i></i> 
                                   Pages
                                </a>
                            </span>
                            <div class=" show">
                                <ul>
                                    <?php
                                    foreach ($pages as $page) {
                                        ?>
                                        <li><span><i class="fa fa-link"></i>
                                                    <a href="/<?php echo $page->slug; ?>"> <?php echo $page->title; ?></a></span>
                                        </li>

                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="span6">
                <div class="tree">
                    <ul>
                        <li>
                                <span>
                                    <a style="color:#000;">
                                    <i class="expanded"><i class="far fa-folder-open"></i></i> 
                                       Other Pages
                                    </a>
                                </span>
                            <div class="show">
                                <ul>
                                    <li><span><i class="fa fa-link"></i><a href="/"> Home</a></span></li>
                                    <li><span class="dropdown"><i class="fa fa-caret-right"></i> Events</span>
                                        <ul class="nested">
                                            <li><span><i class="fa fa-link"></i><a
                                                            href="/events"> Week Calendar </a></span></li>
                                            <li><span><i class="fa fa-link"></i><a
                                                            href="/events/month"> Month Calendar </a></span></li>
                                        </ul>
                                    </li>
                                    <li><span><i class="fa fa-link"></i><a href="/donations"> Donation </a></span></li>
                                    <li><span class="dropdown"><i class="fa fa-caret-right"></i> Blogs </span>
                                        <ul class="nested">

                                            <li><span><i class="fa fa-link"></i><a href="/blog"> Blog Page </a></span>
                                            </li>

                                            <li><span class="dropdown"><i
                                                            class="fa fa-caret-right"></i> Categories </span>
                                                <ul class="nested">
                                                    <?php foreach ($post_categories as $post_category) { // Add Active Post Categories. ?>
                                                        <li><span><i class="fa fa-link"></i><a
                                                                        href="/blog/category/<?php $post_category->slug; ?>"> <?php echo $post_category->name; ?> </a></span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>

                                            <li><span class="dropdown"><i class="fa fa-caret-right"></i> Posts </span>
                                                <ul class="nested">
                                                    <?php foreach ($posts as $post) { // Add Active Posts. ?>
                                                        <li><span><i class="fa fa-link"></i>
                                                                <a href="/sermons/<?php echo $post->slug; ?>"> <?php echo $post->title; ?></a></span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>

                                    </li>
                                    <li><span class="dropdown"><i class="fa fa-caret-right"></i> Sermons</span>
                                        <ul class="nested">
                                            <li><span><i class="fa fa-link"></i><a href="/sermons"> Sermons </a></span>
                                            </li>
                                            <?php
                                            // Add Active Sermons.
                                            foreach ($sermons as $sermon) {
                                                ?>
                                                <li><span><i class="fa fa-link"></i>
                                                                <a href="/sermons/<?php echo $sermon->slug; ?>"> <?php echo $sermon->title; ?></a></span>
                                                </li>

                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <li><span><i class="fa fa-link"></i><a href="/volunteers"> Volunteers </a></span>
                                    </li>
                                    <li><span><i class="fa fa-link"></i><a href="/watch-live"> Watch Live </a></span>
                                    </li>
                                    <li><span><i class="fa fa-link"></i><a href="/contact"> Contact Us </a></span></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>