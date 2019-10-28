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