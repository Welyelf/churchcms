<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_bible_books($key = NULL)
{

    $bible = array(
        'Genesis' => array(
            'name' => 'The First Book of Moses Called Genesis',
            'short_name' => 'Genesis',
            'chapters' => 50,
            'verses' => array(31, 25, 24, 26, 32, 22, 24, 22, 29, 32, 32, 20, 18, 24, 21, 16, 27, 33, 38, 18, 34, 24, 20, 67, 34, 35, 46, 22, 35, 43, 54, 33, 20, 31, 29, 43, 36, 30, 23, 23, 57, 38, 34, 34, 28, 34, 31, 22, 33, 26)
        ),
        'Exodus' => array(
            'name' => 'The Second Book of Moses Called Exodus',
            'short_name' => 'Exodus',
            'chapters' => 40,
            'verses' => array(22, 25, 22, 31, 23, 30, 29, 28, 35, 29, 10, 51, 22, 31, 27, 36, 16, 27, 25, 26, 37, 30, 33, 18, 40, 37, 21, 43, 46, 38, 18, 35, 23, 35, 35, 38, 29, 31, 43, 38)
        ),
        'Leviticus' => array(
            'name' => 'The Third Book of Moses Called Leviticus',
            'short_name' => 'Leviticus',
            'chapters' => 27,
            'verses' => array(17, 16, 17, 35, 26, 23, 38, 36, 24, 20, 47, 8, 59, 57, 33, 34, 16, 30, 37, 27, 24, 33, 44, 23, 55, 46, 34)
        ),
        'Numbers' => array(
            'name' => 'The Fourth Book of Moses Called Numbers',
            'short_name' => 'Numbers',
            'chapters' => 36,
            'verses' => array(54, 34, 51, 49, 31, 27, 89, 26, 23, 36, 35, 16, 33, 45, 41, 35, 28, 32, 22, 29, 35, 41, 30, 25, 19, 65, 23, 31, 39, 17, 54, 42, 56, 29, 34, 13)
        ),
        'Deuteronomy' => array(
            'name' => 'The Fifth Book of Moses Called Deuteronomy',
            'short_name' => 'Deuteronomy',
            'chapters' => 34,
            'verses' => array(46, 37, 29, 49, 33, 25, 26, 20, 29, 22, 32, 31, 19, 29, 23, 22, 20, 22, 21, 20, 23, 29, 26, 22, 19, 19, 26, 69, 28, 20, 30, 52, 29, 12)
        ),
        'Joshua' => array(
            'name' => 'The Book of Joshua',
            'short_name' => 'Joshua',
            'chapters' => 24,
            'verses' => array(18, 24, 17, 24, 15, 27, 26, 35, 27, 43, 23, 24, 33, 15, 63, 10, 18, 28, 51, 9, 45, 34, 16, 33)
        ),
        'Judges' => array(
            'name' => 'The Book of Judges',
            'short_name' => 'Judges',
            'chapters' => 21,
            'verses' => array(36, 23, 31, 24, 31, 40, 25, 35, 57, 18, 40, 15, 25, 20, 20, 31, 13, 31, 30, 48, 25)
        ),
        'Ruth' => array(
            'name' => 'The Book of Ruth',
            'short_name' => 'Ruth',
            'chapters' => 4,
            'verses' => array(22, 23, 18, 22)
        ),
        '1 Samuel' => array(
            'name' => 'The First Book of Samuel',
            'short_name' => '1 Samuel',
            'chapters' => 31,
            'verses' => array(28, 36, 21, 22, 12, 21, 17, 22, 27, 27, 15, 25, 23, 52, 35, 23, 58, 30, 24, 42, 16, 23, 28, 23, 44, 25, 12, 25, 11, 31, 13)
        ),
        '2 Samuel' => array(
            'name' => 'The Second Book of Samuel',
            'short_name' => '2 Samuel',
            'chapters' => 24,
            'verses' => array(27, 32, 39, 12, 25, 23, 29, 18, 13, 19, 27, 31, 39, 33, 37, 23, 29, 32, 44, 26, 22, 51, 39, 25)
        ),
        '1 Kings' => array(
            'name' => 'The First Book of Kings',
            'short_name' => '1 Kings',
            'chapters' => 22,
            'verses' => array(53, 46, 28, 20, 32, 38, 51, 66, 28, 29, 43, 33, 34, 31, 34, 34, 24, 46, 21, 43, 29, 54)
        ),
        '2 Kings' => array(
            'name' => 'The Second Book of Kings',
            'short_name' => '2 Kings',
            'chapters' => 25,
            'verses' => array(18, 25, 27, 44, 27, 33, 20, 29, 37, 36, 20, 22, 25, 29, 38, 20, 41, 37, 37, 21, 26, 20, 37, 20, 30)
        ),
        '1 Chronicles' => array(
            'name' => 'The First Book of Chronicles',
            'short_name' => '1 Chronicles',
            'chapters' => 29,
            'verses' => array(54, 55, 24, 43, 41, 66, 40, 40, 44, 14, 47, 41, 14, 17, 29, 43, 27, 17, 19, 8, 30, 19, 32, 31, 31, 32, 34, 21, 30)
        ),
        '2 Chronicles' => array(
            'name' => 'The Second Book of Chronicles',
            'short_name' => '2 Chronicles',
            'chapters' => 36,
            'verses' => array(18, 17, 17, 22, 14, 42, 22, 18, 31, 19, 23, 16, 23, 14, 19, 14, 19, 34, 11, 37, 20, 12, 21, 27, 28, 23, 9, 27, 36, 27, 21, 33, 25, 33, 27, 23)
        ),
        'Ezra' => array(
            'name' => 'The Book of Ezra',
            'short_name' => 'Ezra',
            'chapters' => 10,
            'verses' => array(11, 70, 13, 24, 17, 22, 28, 36, 15, 44)
        ),
        'Nehemiah' => array(
            'name' => 'The Book of Nehemiah',
            'short_name' => 'Nehemiah',
            'chapters' => 13,
            'verses' => array(11, 20, 38, 17, 19, 19, 72, 18, 37, 40, 36, 47, 31)
        ),
        'Esther' => array(
            'name' => 'The Book of Esther',
            'short_name' => 'Esther',
            'chapters' => 10,
            'verses' => array(22, 23, 15, 17, 14, 14, 10, 17, 32, 3)
        ),
        'Job' => array(
            'name' => 'The Book of Job',
            'short_name' => 'Job',
            'chapters' => 42,
            'verses' => array(22, 13, 26, 21, 27, 30, 21, 22, 35, 22, 20, 25, 28, 22, 35, 22, 16, 21, 29, 29, 34, 30, 17, 25, 6, 14, 23, 28, 25, 31, 40, 22, 33, 37, 16, 33, 24, 41, 30, 32, 26, 17)
        ),
        'Psalms' => array(
            'name' => 'The Book of Psalms',
            'short_name' => 'Psalms',
            'chapters' => 150,
            'verses' => array(6, 11, 9, 9, 13, 11, 18, 10, 21, 18, 7, 9, 6, 7, 5, 11, 15, 51, 15, 10, 14, 32, 6, 10, 22, 12, 14, 9, 11, 13, 25, 11, 22, 23, 28, 13, 40, 23, 14, 18, 14, 12, 5, 27, 18, 12, 10, 15, 21, 23, 21, 11, 7, 9, 24, 14, 12, 12, 18, 14, 9, 13, 12, 11, 14, 20, 8, 36, 37, 6, 24, 20, 28, 23, 11, 13, 21, 72, 13, 20, 17, 8, 19, 13, 14, 17, 7, 19, 53, 17, 16, 16, 5, 23, 11, 13, 12, 9, 9, 5, 8, 29, 22, 35, 45, 48, 43, 14, 31, 7, 10, 10, 9, 8, 18, 19, 2, 29, 176, 7, 8, 9, 4, 8, 5, 6, 5, 6, 8, 8, 3, 18, 3, 3, 21, 26, 9, 8, 24, 14, 10, 8, 12, 15, 21, 10, 20, 14, 9, 6)
        ),
        'Proverbs' => array(
            'name' => 'The Book of Proverbs',
            'short_name' => 'Proverbs',
            'chapters' => 31,
            'verses' => array(33, 22, 35, 27, 23, 35, 27, 36, 18, 32, 31, 28, 25, 35, 33, 33, 28, 24, 29, 30, 31, 29, 35, 34, 28, 28, 27, 28, 27, 33, 31)
        ),
        'Ecclesiastes' => array(
            'name' => 'The Book of Ecclesiastes',
            'short_name' => 'Ecclesiastes',
            'chapters' => 12,
            'verses' => array(18, 26, 22, 17, 19, 12, 29, 17, 18, 20, 10, 14)
        ),
        'Songs' => array(
            'name' => 'The Song of Songs',
            'short_name' => 'Song of Solomon',
            'chapters' => 8,
            'verses' => array(17, 17, 11, 16, 16, 12, 14, 14)
        ),
        'Isaiah' => array(
            'name' => 'The Book of Isaiah',
            'short_name' => 'Isaiah',
            'chapters' => 66,
            'verses' => array(31, 22, 26, 6, 30, 13, 25, 23, 20, 34, 16, 6, 22, 32, 9, 14, 14, 7, 25, 6, 17, 25, 18, 23, 12, 21, 13, 29, 24, 33, 9, 20, 24, 17, 10, 22, 38, 22, 8, 31, 29, 25, 28, 28, 25, 13, 15, 22, 26, 11, 23, 15, 12, 17, 13, 12, 21, 14, 21, 22, 11, 12, 19, 11, 25, 24)
        ),
        'Jeremiah' => array(
            'name' => 'The Book of Jeremiah',
            'short_name' => 'Jeremiah',
            'chapters' => 52,
            'verses' => array(19, 37, 25, 31, 31, 30, 34, 23, 25, 25, 23, 17, 27, 22, 21, 21, 27, 23, 15, 18, 14, 30, 40, 10, 38, 24, 22, 17, 32, 24, 40, 44, 26, 22, 19, 32, 21, 28, 18, 16, 18, 22, 13, 30, 5, 28, 7, 47, 39, 46, 64, 34)
        ),
        'Lamentations' => array(
            'name' => 'The Book of Lamentations',
            'short_name' => 'Lamentations',
            'chapters' => 5,
            'verses' => array(22, 22, 66, 22, 22)
        ),
        'Ezekiel' => array(
            'name' => 'The Book of Ezekiel',
            'short_name' => 'Ezekiel',
            'chapters' => 48,
            'verses' => array(28, 10, 27, 17, 17, 14, 27, 18, 11, 22, 25, 28, 23, 23, 8, 63, 24, 32, 14, 44, 37, 31, 49, 27, 17, 21, 36, 26, 21, 26, 18, 32, 33, 31, 15, 38, 28, 23, 29, 49, 26, 20, 27, 31, 25, 24, 23, 35)
        ),
        'Daniel' => array(
            'name' => 'The Book of Daniel',
            'short_name' => 'Daniel',
            'chapters' => 12,
            'verses' => array(21, 49, 100, 34, 30, 29, 28, 27, 27, 21, 45, 13, 64, 42)
        ),
        'Hosea' => array(
            'name' => 'The Book of Hosea',
            'short_name' => 'Hosea',
            'chapters' => 14,
            'verses' => array(9, 25, 5, 19, 15, 11, 16, 14, 17, 15, 11, 15, 15, 10)
        ),
        'Joel' => array(
            'name' => 'The Book of Joel',
            'short_name' => 'Joel',
            'chapters' => 3,
            'verses' => array(20, 27, 5, 21)
        ),
        'Amos' => array(
            'name' => 'The Book of Amos',
            'short_name' => 'Amos',
            'chapters' => 9,
            'verses' => array(15, 16, 15, 13, 27, 14, 17, 14, 15)
        ),
        'Obadiah' => array(
            'name' => 'The Book of Obadiah',
            'short_name' => 'Obadiah',
            'chapters' => 1,
            'verses' => array(21)
        ),
        'Jonah' => array(
            'name' => 'The Book of Jonah',
            'short_name' => 'Jonah',
            'chapters' => 4,
            'verses' => array(16, 11, 10, 11)
        ),
        'Micah' => array(
            'name' => 'The Book of Micah',
            'short_name' => 'Micah',
            'chapters' => 7,
            'verses' => array(16, 13, 12, 14, 14, 16, 20)
        ),
        'Nahum' => array(
            'name' => 'The Book of Nahum',
            'short_name' => 'Nahum',
            'chapters' => 3,
            'verses' => array(14, 14, 19)
        ),
        'Habakkuk' => array(
            'name' => 'The Book of Habakkuk',
            'short_name' => 'Habakkuk',
            'chapters' => 3,
            'verses' => array(17, 20, 19)
        ),
        'Zephaniah' => array(
            'name' => 'The Book of Zephaniah',
            'short_name' => 'Zephaniah',
            'chapters' => 3,
            'verses' => array(18, 15, 20)
        ),
        'Haggai' => array(
            'name' => 'The Book of Haggai',
            'short_name' => 'Haggai',
            'chapters' => 2,
            'verses' => array(15, 23)
        ),
        'Zechariah' => array(
            'name' => 'The Book of Zechariah',
            'short_name' => 'Zechariah',
            'chapters' => 14,
            'verses' => array(17, 17, 10, 14, 11, 15, 14, 23, 17, 12, 17, 14, 9, 21)
        ),
        'Malachi' => array(
            'name' => 'The Book of Malachi',
            'short_name' => 'Malachi',
            'chapters' => 4,
            'verses' => array(14, 17, 24)
        ),
        'Matthew' => array(
            'name' => 'The Gospel According to Matthew',
            'short_name' => 'Matthew',
            'chapters' => 28,
            'verses' => array(25, 23, 17, 25, 48, 34, 29, 34, 38, 42, 30, 50, 58, 36, 39, 28, 27, 35, 30, 34, 46, 46, 39, 51, 46, 75, 66, 20)
        ),
        'Mark' => array(
            'name' => 'The Gospel According to Mark',
            'short_name' => 'Mark',
            'chapters' => 16,
            'verses' => array(45, 28, 35, 41, 43, 56, 37, 38, 50, 52, 33, 44, 37, 72, 47, 20)
        ),
        'Luke' => array(
            'name' => 'The Gospel According to Luke',
            'short_name' => 'Luke',
            'chapters' => 24,
            'verses' => array(80, 52, 38, 44, 39, 49, 50, 56, 62, 42, 54, 59, 35, 35, 32, 31, 37, 43, 48, 47, 38, 71, 56, 53)
        ),
        'John' => array(
            'name' => 'The Gospel According to John',
            'short_name' => 'John',
            'chapters' => 21,
            'verses' => array(51, 25, 36, 54, 47, 71, 53, 59, 41, 42, 57, 50, 38, 31, 27, 33, 26, 40, 42, 31, 25)
        ),
        'Acts' => array(
            'name' => 'The Acts of the Apostles',
            'short_name' => 'Acts',
            'chapters' => 28,
            'verses' => array(26, 47, 26, 37, 42, 15, 60, 40, 43, 49, 30, 25, 52, 28, 41, 40, 34, 28, 40, 38, 40, 30, 35, 27, 27, 32, 44, 31)
        ),
        'Romans' => array(
            'name' => 'The Epistle of Paul to the Romans',
            'short_name' => 'Romans',
            'chapters' => 16,
            'verses' => array(32, 29, 31, 25, 21, 23, 25, 39, 33, 21, 36, 21, 14, 23, 33, 27)
        ),
        '1 Corinthians' => array(
            'name' => 'The First Epistle of Paul to the Corinthians',
            'short_name' => '1 Corinthians',
            'chapters' => 16,
            'verses' => array(31, 16, 23, 21, 13, 20, 40, 13, 27, 33, 34, 31, 13, 40, 58, 24)
        ),
        '2 Corinthians' => array(
            'name' => 'The Second Epistle of Paul to the Corinthians',
            'short_name' => '2 Corinthians',
            'chapters' => 13,
            'verses' => array(24, 17, 18, 18, 21, 18, 16, 24, 15, 18, 33, 21, 14)
        ),
        'Galatians' => array(
            'name' => 'The Epistle of Paul to the Galatians',
            'short_name' => 'Galatians',
            'chapters' => 6,
            'verses' => array(24, 21, 29, 31, 26, 18)
        ),
        'Ephesians' => array(
            'name' => 'The Epistle of Paul to the Ephesians',
            'short_name' => 'Ephesians',
            'chapters' => 6,
            'verses' => array(23, 22, 21, 32, 33, 24)
        ),
        'Philippians' => array(
            'name' => 'The Epistle of Paul to the Philippians',
            'short_name' => 'Philippians',
            'chapters' => 4,
            'verses' => array(30, 30, 21, 23)
        ),
        'Colossians' => array(
            'name' => 'The Epistle of Paul to the Colossians',
            'short_name' => 'Colossians',
            'chapters' => 4,
            'verses' => array(29, 23, 25, 18)
        ),
        '1 Thessalonians' => array(
            'name' => 'The First Epistle of Paul to the Thessalonians',
            'short_name' => '1 Thessalonians',
            'chapters' => 5,
            'verses' => array(10, 20, 13, 18, 28)
        ),
        '2 Thessalonians' => array(
            'name' => 'The Second Epistle of Paul to the Thessalonians',
            'short_name' => '2 Thessalonians',
            'chapters' => 3,
            'verses' => array(12, 17, 18)
        ),
        '1 Timothy' => array(
            'name' => 'The First Epistle of Paul to Timothy',
            'short_name' => '1 Timothy',
            'chapters' => 6,
            'verses' => array(20, 15, 16, 16, 25, 21)
        ),
        '2 Timothy' => array(
            'name' => 'The Second Epistle of Paul to Timothy',
            'short_name' => '2 Timothy',
            'chapters' => 4,
            'verses' => array(18, 26, 17, 22)
        ),
        'Titus' => array(
            'name' => 'The Epistle of Paul to Titus',
            'short_name' => 'Titus',
            'chapters' => 3,
            'verses' => array(16, 15, 15)
        ),
        'Philemon' => array(
            'name' => 'The Epistle of Paul to Philemon',
            'short_name' => 'Philemon',
            'chapters' => 1,
            'verses' => array(25)
        ),
        'Hebrews' => array(
            'name' => 'The Epistle to the Hebrews',
            'short_name' => 'Hebrews',
            'chapters' => 13,
            'verses' => array(14, 18, 19, 16, 14, 20, 28, 13, 28, 39, 40, 29, 25)
        ),
        'James' => array(
            'name' => 'The General Epistle of James',
            'short_name' => 'James',
            'chapters' => 5,
            'verses' => array(27, 26, 18, 17, 20)
        ),
        '1 Peter' => array(
            'name' => 'The First Epistle of Peter',
            'short_name' => '1 Peter',
            'chapters' => 5,
            'verses' => array(25, 25, 22, 19, 14)
        ),
        '2 Peter' => array(
            'name' => 'The Second Epistle of Peter',
            'short_name' => '2 Peter',
            'chapters' => 3,
            'verses' => array(21, 22, 18)
        ),
        '1 John' => array(
            'name' => 'The First Epistle of John',
            'short_name' => '1 John',
            'chapters' => 5,
            'verses' => array(10, 29, 24, 21, 21)
        ),
        '2 John' => array(
            'name' => 'The Second Epistle of John',
            'short_name' => '2 John',
            'chapters' => 1,
            'verses' => array(13)
        ),
        '3 John' => array(
            'name' => 'The Third Epistle of John',
            'short_name' => '3 John',
            'chapters' => 1,
            'verses' => array(15)
        ),
        'Jude' => array(
            'name' => 'The Epistle of Jude',
            'short_name' => 'Jude',
            'chapters' => 1,
            'verses' => array(25)
        ),
        'Revelation' => array(
            'name' => 'The Book of Revelation',
            'short_name' => 'Revelation',
            'chapters' => 22,
            'verses' => array(20, 29, 22, 11, 14, 17, 17, 13, 21, 11, 19, 18, 18, 20, 8, 21, 18, 24, 21, 15, 27, 21)
        )
    );

    if ($key) {
        if(array_key_exists($key, $bible )){
            return (object)$bible[$key];
        }else{
            return "";
        }

    }

    return $bible;
}

function get_scripture_label_new($input)
{
    $tmp_arr = explode("|", $input);
    $label = $tmp_arr[0] . " ";

    if ($tmp_arr[1] == $tmp_arr[3]) {
        if ($tmp_arr[2] == $tmp_arr[4]) {
            $label .= $tmp_arr[1] . ":" . $tmp_arr[2];
        } else {
            $label .= $tmp_arr[1] . ":" . $tmp_arr[2] . "-" . $tmp_arr[4];
        }
    } else {
        $label .= $tmp_arr[1] . ":" . $tmp_arr[2] . " - " . $tmp_arr[3] . ":" . $tmp_arr[4];
    }

    return $label;
}

function get_scripture_label($input)
{
    //$tmp_arr = explode("|", $input);

    // Return N/A if passage is blank.
    if (!$input[0]) {
        return $label = "N/A";
    }

    // Initialize label.
    $label = $input[0] . " ";

    // Return only Book name if chapters and verses are blank.
    if (!$input[1] && !$input[2] && !$input[3] && !$input[4])
        return $label;

    if ($input[1] == $input[3]) {
        if ($input[2] == $input[4]) {
            $label .= $input[1] . ":" . $input[2];
        } else {
            $label .= $input[1] . ":" . $input[2] . "-" . $input[4];
        }
    } else {
        // If only "chapter from" has data.
        if ($input[1] && !$input[2] && !$input[3] && !$input[4])
            $label .= $input[1];
        else
            $label .= $input[1] . ":" . $input[2] . " - " . $input[3] . ":" . $input[4];
    }

    return $label;
}

/**
 *   Convert book to slug or vice versa.
 * @return string slug
 */
function get_book_slug($key, $slug = TRUE)
{
    if ($slug) {
        return str_replace(' ', '-', $key);
    } else {
        return str_replace('-', ' ', $key);
    }
}