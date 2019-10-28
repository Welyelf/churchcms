<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Database_schema
{
    function add_fields()
    {
        // fields that will be added to database
        // array (table name,field name,type,constraint or size ,Isnull)

        $add_fields = array(
            array("hits", 'status_code', 'varchar', 20, 'TRUE'),
            array("categories", 'description', 'varchar', 500, 'TRUE'),
            array("pages", 'seo_meta_title', 'varchar', 60, 'TRUE'),
            array("pages", 'seo_meta_description', 'varchar', 160, 'TRUE'),
            array("posts", 'seo_meta_description', 'varchar', 160, 'TRUE'),
            array("posts", 'seo_meta_title', 'varchar', 60, 'TRUE'),
            array("sermons", 'seo_meta_title', 'varchar', 60, 'TRUE'),
            array("sermons", 'seo_meta_description', 'varchar', 160, 'TRUE'),
            array("categories", 'seo_meta_title', 'varchar', 60, 'TRUE'),
            array("categories", 'seo_meta_description', 'varchar', 160, 'TRUE'),
            array("pages", 'page_css', 'mediumtext', 0, 'TRUE'),
        );
        return $add_fields;
    }

    function get_all_database()
    {
        $list_of_tables = array(
            'categories', 'customizations', 'donations', 'emails', 'events', 'files', 'hits', 'logs', 'orders', 'pages', 'plans',
            'posts', 'post_categories', 'sermons', 'sermon_scriptures', 'settings', 'subscribers', 'tmp_transcript', 'transcript_requests',
            'users', 'volunteers', 'volunteers_file'
        );
        return $list_of_tables;
    }

    function get_table_fields()
    {
        $database_schema = array(
            'categories' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'slug',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'description',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'seo_meta_title',
                    'type' => 'varchar',
                    'size' => 60,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'seo_meta_description',
                    'type' => 'varchar',
                    'size' => 160,
                    'is_null' => TRUE,
                ),
            ),
            'customizations' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => FALSE,
                ),
                2 => array(
                    'name' => 'is_enabled',
                    'type' => 'tinyint',
                    'size' => 4,
                    'is_null' => FALSE,
                ),
                3 => array(
                    'name' => 'model_parameters',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'view_parameters',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),
                5 => array(
                    'name' => 'ordering',
                    'type' => 'tinyint',
                    'size' => 4,
                    'is_null' => FALSE,
                ),
                6 => array(
                    'name' => 'location',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => FALSE,
                ),
                7 => array(
                    'name' => 'custom_css',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => FALSE,
                ),
                8 => array(
                    'name' => 'custom_js',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => FALSE,
                ),
                9 => array(
                    'name' => 'function_name',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => FALSE,
                ),
                10 => array(
                    'name' => 'description',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
            ),
            'donations' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'email',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'amount',
                    'type' => 'decimal',
                    'size' => '10,4',
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'status',
                    'type' => 'varchar',
                    'size' => 10,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'timestamp',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'stripe_cust_id',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => FALSE,
                ),
                6 => array(
                    'name' => 'subscription_id',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => FALSE,
                ),
                7 => array(
                    'name' => 'stripe_json_response',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),

            ),
            'emails' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'slug',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'template',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
            ),
            'events' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'title',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'location',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'datetime',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'details',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'recurrence',
                    'type' => 'varchar',
                    'size' => 10,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'time',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'end_time',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                8 => array(
                    'name' => 'end_date',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                9 => array(
                    'name' => 'day_weekly',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                10 => array(
                    'name' => 'day_monthly',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                11 => array(
                    'name' => 'day_yearly',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                12 => array(
                    'name' => 'month_yearly',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                13 => array(
                    'name' => 'order_others',
                    'type' => 'varchar',
                    'size' => 10,
                    'is_null' => TRUE,
                ),
                14 => array(
                    'name' => 'weekday_others',
                    'type' => 'varchar',
                    'size' => 10,
                    'is_null' => TRUE,
                ),
                15 => array(
                    'name' => 'month_others',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
            ),
            'files' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'ext',
                    'type' => 'varchar',
                    'size' => 10,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'size',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'mime_type',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'created_at',
                    'type' => 'datetime',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'updated_at',
                    'type' => 'datetime',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'path',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => FALSE,
                ),
            ),
            'hits' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'uri',
                    'type' => 'varchar',
                    'size' => 250,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'count',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'sessions',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'date',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'is_total',
                    'type' => 'tinyint',
                    'size' => 4,
                    'is_null' => FALSE,
                ),
                6 => array(
                    'name' => 'status_code',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => FALSE,
                ),
            ),
            'logs' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'level',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'message',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'php_error',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'datetime',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'orders' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'type',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'client_name',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'client_email',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'youtube_link',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'video_link',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'client_notes',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'amount',
                    'type' => 'decimal',
                    'size' => '10,0',
                    'is_null' => TRUE,
                ),
                8 => array(
                    'name' => 'status',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => TRUE,
                ),
                9 => array(
                    'name' => 'date',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'pages' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'title',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'slug',
                    'type' => 'varchar',
                    'size' => 300,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'content',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'author_id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'subtitle',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'template',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'status',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                8 => array(
                    'name' => 'is_active',
                    'type' => 'int',
                    'size' => 2,
                    'is_null' => FALSE,
                ),
                9 => array(
                    'name' => 'seo_meta_title',
                    'type' => 'varchar',
                    'size' => 60,
                    'is_null' => TRUE,
                ),
                10 => array(
                    'name' => 'seo_meta_description',
                    'type' => 'varchar',
                    'size' => 160,
                    'is_null' => TRUE,
                ),
            ),
            'plans' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'nice_name',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'description',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),
                4 => array(
                    'name' => 'interval',
                    'type' => 'varchar',
                    'size' => 10,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'currency',
                    'type' => 'varchar',
                    'size' => 3,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'amount',
                    'type' => 'decimal',
                    'size' => '10,0',
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'is_fixed',
                    'type' => 'tinyint',
                    'size' => 4,
                    'is_null' => FALSE,
                ),
                8 => array(
                    'name' => 'order',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
            ),
            'posts' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'title',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'slug',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'content',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'author_id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'date',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'status',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'is_active',
                    'type' => 'int',
                    'size' => 2,
                    'is_null' => FALSE,
                ),
                8 => array(
                    'name' => 'seo_meta_title',
                    'type' => 'varchar',
                    'size' => 60,
                    'is_null' => TRUE,
                ),
                9 => array(
                    'name' => 'seo_meta_description',
                    'type' => 'varchar',
                    'size' => 160,
                    'is_null' => TRUE,
                ),
            ),
            'post_categories' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'post_id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'category_id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'sermons' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'title',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'slug',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => FALSE,
                ),
                3 => array(
                    'name' => 'pastor',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'passage',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'date',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'youtube_id',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'mp3_link',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                8 => array(
                    'name' => 'transcript',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                9 => array(
                    'name' => 'transcript_link',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                10 => array(
                    'name' => 'bulletin_link',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                11 => array(
                    'name' => 'file_attachments',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),
                12 => array(
                    'name' => 'is_active',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                    'default_val' => 1,
                ),
                13 => array(
                    'name' => 'seo_meta_title',
                    'type' => 'varchar',
                    'size' => 60,
                    'is_null' => TRUE,
                ),
                14 => array(
                    'name' => 'seo_meta_description',
                    'type' => 'varchar',
                    'size' => 160,
                    'is_null' => TRUE,
                ),
            ),
            'sermon_scriptures' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'sermon_id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'book_id',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'chapter_from',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'verse_from',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'chapter_to',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'verse_to',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'settings' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'display_name',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => FALSE,
                ),
                3 => array(
                    'name' => 'value',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'description',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => FALSE,
                ),
                5 => array(
                    'name' => 'type',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => FALSE,
                ),
                6 => array(
                    'name' => 'permissions',
                    'type' => 'varchar',
                    'size' => 50,
                    'is_null' => FALSE,
                ),
                7 => array(
                    'name' => 'classification',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'subscribers' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'email',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'is_active',
                    'type' => 'tinyint',
                    'size' => 4,
                    'is_null' => FALSE,
                ),
                4 => array(
                    'name' => 'date',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
            ),
            'tmp_transcript' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'youtube_id',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => FALSE,
                ),
                2 => array(
                    'name' => 'transcript',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),
                3 => array(
                    'name' => 'with_punct',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),
                4 => array(
                    'name' => 'html',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => FALSE,
                ),
            ),
            'transcript_requests' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'sermon_id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'email',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'datetime',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'users' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'stripe_cust_id',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'first_name',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'last_name',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'username',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'email',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => TRUE,
                ),
                6 => array(
                    'name' => 'password',
                    'type' => 'varchar',
                    'size' => 100,
                    'is_null' => TRUE,
                ),
                7 => array(
                    'name' => 'role',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => TRUE,
                ),
                8 => array(
                    'name' => 'about',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                9 => array(
                    'name' => 'street',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                10 => array(
                    'name' => 'city',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                11 => array(
                    'name' => 'state',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                12 => array(
                    'name' => 'zip',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                13 => array(
                    'name' => 'country',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                14 => array(
                    'name' => 'mobile',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
                15 => array(
                    'name' => 'landline',
                    'type' => 'varchar',
                    'size' => 255,
                    'is_null' => TRUE,
                ),
            ),
            'volunteers' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'volunteer_type',
                    'type' => 'varchar',
                    'size' => 20,
                    'is_null' => TRUE,
                ),
                2 => array(
                    'name' => 'persons',
                    'type' => 'text',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                3 => array(
                    'name' => 'location',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => TRUE,
                ),
                4 => array(
                    'name' => 'details',
                    'type' => 'mediumtext',
                    'size' => '',
                    'is_null' => TRUE,
                ),
                5 => array(
                    'name' => 'datetime',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => TRUE,
                ),
            ),
            'volunteers_file' => array(
                0 => array(
                    'name' => 'id',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                1 => array(
                    'name' => 'name',
                    'type' => 'varchar',
                    'size' => 200,
                    'is_null' => FALSE,
                ),
                2 => array(
                    'name' => 'file',
                    'type' => 'varchar',
                    'size' => 500,
                    'is_null' => FALSE,
                ),
                3 => array(
                    'name' => 'is_active',
                    'type' => 'int',
                    'size' => 11,
                    'is_null' => FALSE,
                ),
                4 => array(
                    'name' => 'date_modified',
                    'type' => 'datetime',
                    'size' => '',
                    'is_null' => FALSE,
                ),
            ),
        );
        return $database_schema;
    }


}


