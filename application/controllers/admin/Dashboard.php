<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->check(array("Super Admin", "Admin"));
    }

    public function index()
    {
        $this->data['stats'] = $this->hits->get_todays_top();

        // PAGE VIEWS GRAPH DATA ------------------------------------------------------

        $graph_labels = array();
        $graph_data = array();
        $graph_days_offset = "-30";
        $today = strtotime(date('d-M-Y'));

        $date_range['from'] = strtotime($graph_days_offset . " day", $today);
        $date_range['to'] = $today;

        $daily_totals = $this->hits->get_daily_totals($date_range, 'ASC');


        for ($x = 0; $x <= 30; $x++) {
            $timestamp = strtotime("+{$x} day", $date_range['from']);
            array_push($graph_labels, date('m-d-y', $timestamp));
            $graph_data[date('m-d-y', $timestamp)] = 0;
        }

        foreach ($daily_totals as $daily_total) {
            $graph_data[date('m-d-y', $daily_total->date)] = (int)$daily_total->count;
        }

        ksort($graph_data);
        $graph_data = array_values($graph_data);

        $this->data['graph_labels'] = json_encode($graph_labels);
        $this->data['graph_data'] = json_encode($graph_data);

        // END PAGE VIEWS GRAPH DATA -------------------------------------------------------

        // Set date_from to 1 month interval.
        $date_from = strtotime('-1 months');
        $date_to = now();

        // Get Number of Recent Sermons, Subscribers and Posts.
        $this->data['new_sermons'] = $this->sermons->get_new_sermons($date_from);
        $this->data['total_sermons'] = $this->sermons->get_row_count();

        $this->data['new_subscribers'] = $this->subscribers->get_new_subscribers($date_from);
        $this->data['total_subscribers'] = $this->subscribers->get_row_count();

        $this->data['new_posts'] = $this->posts->get_new_posts($date_from);
        $this->data['total_posts'] = $this->posts->get_row_count();

        $this->data['total_events'] = $this->events->get_row_count();

        // TOP 5 MOST POPULAR SERMONS. -----------------------------------------------------

        // Get Top 5 Most Popular Sermons from hits data.
        $top_sermons = $this->hits->get_top_sermons();
        // Initialize arrays for graphs and new array;
        $top_sermons_graph_data = array();
        $top_sermons_graph_label = array();
        $top_sermons_new = array();
        // Loop top sermons.
        foreach ($top_sermons as $sermon) {
            // Push the sermon count as graph data.
            array_push($top_sermons_graph_data, $sermon->count);
            // Get Sermon detail using the slug.
            $sermon_detail = $this->sermons->get_sermon_by_slug(str_replace('sermons/view/', '', $sermon->uri));

            // Check first if sermon still existing.
            if ($sermon_detail) {
                // Push the sermon title as graph label.
                array_push($top_sermons_graph_label, $sermon_detail->title);
                // Append sermon title to current sermon.
                $sermon->title = $sermon_detail->title;
                // Set True if Sermon still existing.
                $sermon->is_exist = TRUE;
            } // Use URI if sermon does not exist anymore.
            else {
                $sermon->title = $sermon->uri;
                array_push($top_sermons_graph_label, $sermon->title);

                // Set False if Sermon does not exist anymore.
                $sermon->is_exist = FALSE;
            }

            // Push the current sermon as top sermon.
            array_push($top_sermons_new, $sermon);
        }
        // Set the Top Sermons for the table.
        $this->data['top_sermons'] = $top_sermons_new;
        // Set the data for Top Sermons Graph data and label.
        $this->data['top_sermons_graph_data'] = json_encode($top_sermons_graph_data);
        $this->data['top_sermons_graph_label'] = json_encode($top_sermons_graph_label);

        // END TOP 5 MOST POPULAR SERMONS. ------------------------------------------------

        // TOP BOOKS BY NUMBER OF SERMONS. ------------------------------------------------

        // Get Top 5 Most Popular Sermons from hits data.
        $top_books = $this->sermon_scriptures_model->get_top_books_by_sermons();
        // Initialize arrays for graphs and new array;
        $top_books_graph_data = array();
        $top_books_graph_label = array();

        // Loop top books then push data and labels.
        foreach ($top_books as $book) {
            // Push the books count as graph data.
            array_push($top_books_graph_data, $book->total_sermons);
            // Push the books title as graph label.
            array_push($top_books_graph_label, $book->book_id);
        }


        $this->data['top_books'] = $top_books;
        // Set the data for Top Sermons Graph data and label.
        $this->data['top_books_graph_data'] = json_encode($top_books_graph_data);
        $this->data['top_books_graph_label'] = json_encode($top_books_graph_label);

        // END TOP BOOKS BY NUMBER OF SERMONS. --------------------------------------------

        // UPCOMING EVENTS ----------------------------------------------------------------

        $start_date = date('Y-m-d');
        $date_range = date_range($start_date, 6, FALSE, 'Y-m-d');

        $upcoming_events = array();
        $events_this_week = 0;
        foreach ($date_range as $date) {
            $upcoming_events[strtotime($date)] = array();
        }

        $recurring_events = $this->events->get_week_events($date_range[6]);

        foreach ($recurring_events as $event) {
            // Fix to show events that are not showing with none recurrence.
            switch ($event->recurrence) {
                case 'none':
                    foreach ($date_range as $date) {
                        // Set current date from unix to human.
                        $curdate = date('Y-m-d', $event->datetime);
                        // Check if date is same from database date. Then push to the date box.
                        if ($date == $curdate) {
                            array_push($upcoming_events[strtotime($date)], $event);
                            $events_this_week++;
                        }
                    }
                    break;
                case 'daily':
                    foreach ($date_range as $date) {
                        // Set End date.
                        $to = strtotime($date . '0:00');
                        // Check if end date same with date range end. Then push event data to upcoming events.
                        if ($to <= $event->end_date) {
                            array_push($upcoming_events[strtotime($date)], $event);
                            $events_this_week++;
                        }
                    }
                    break;
                case 'weekly':
                    //$days = str_split ($event->day_weekly,1); // days of the week to recur
                    $day_of_the_week = date('w');

                    if ($day_of_the_week > $event->day_weekly) {
                        $days = str_split((7 - (date('w')) + $event->day_weekly), 1);  // occur on the actual day
                    } else if ($day_of_the_week < $event->day_weekly) {
                        $days = str_split(($event->day_weekly - $day_of_the_week), 1);
                    } else if ($day_of_the_week == $event->day_weekly) {
                        $days = str_split((0), 1);
                    } else {
                        $days = str_split($event->day_weekly, 1);
                    }

                    foreach ($days as $day_of_week) {
                        array_push($upcoming_events[strtotime($date_range[$day_of_week])], $event);
                        $events_this_week++;
                    }
                    break;
                case 'monthly':
                    if ($event->day_monthly < 10) {
                        $event->day_monthly = '0' . $event->day_monthly;
                    }

                    foreach ($date_range as $date) {
                        $recur_date = substr($date, 0, 8) . $event->day_monthly;
                        if ($date == $recur_date) {
                            array_push($upcoming_events[strtotime($date)], $event);
                            $events_this_week++;
                        }
                    }
                    break;
                case 'yearly':
                    if ($event->day_yearly < 10) {
                        $event->day_yearly = '0' . $event->day_yearly;
                    }
                    if ($event->month_yearly < 10) {
                        $event->month_yearly = '0' . $event->month_yearly;
                    }

                    foreach ($date_range as $date) {
                        $recur_date = substr($date, 0, 5) . $event->month_yearly . '-' . $event->day_yearly;
                        if ($date == $recur_date) {
                            array_push($upcoming_events[strtotime($date)], $event);
                            $events_this_week++;
                        }
                    }
                    break;
                case 'others':
                    $year = date('Y');
                    $months = explode("|", $event->month_others);
                    foreach ($months as $month) {
                        $date = date_create($event->order_others . " " . $event->weekday_others . " of " . get_month($month) . " " . $year);
                        $date = date_format($date, "Y-m-d");
                        if (in_array($date, $date_range)) {
                            array_push($upcoming_events[strtotime($date)], $event);
                            $events_this_week++;
                        }
                    }
                    break;
                default:
                    log_message('error', "Unexpected event recurrence type '$event->recurrence'.");
                    break;
            }
        }

        foreach ($upcoming_events as $key => $event_list) {
            if (count($event_list) > 1) {
                usort($event_list, 'sortByTime');
                $upcoming_events[$key] = $event_list;
            }
        }

        $this->data['upcoming_events'] = $upcoming_events;
        $this->data['events_this_week'] = $events_this_week;

        // END UPCOMING EVENTS ------------------------------------------------------------

        $this->load->view('layout/backend/master', $this->data);
    }
}
