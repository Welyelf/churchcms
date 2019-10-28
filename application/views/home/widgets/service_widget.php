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