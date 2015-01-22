<?php

    $sql = 'SELECT
    tbl_books.book_id,
    tbl_books.book_title,
    tbl_books.book_author,
    tbl_genres.gen_name
    FROM
    tbl_books
    INNER JOIN
    tbl_genres ON tbl_books.book_fk_gen_id = tbl_genres.gen_id
    ORDER BY book_title ASC';                                                // raw SQL query to select records

    $paging = ['currPage'=>$_GET['page'], 'recPerPage'=>5];             // optional parameter to set the returns in pages
    $records = $qry->getRecords($sql, $paging);                              // returns associative array [info, data]
    $_contents->setVariable($records['info']);                               // assign "info" values to placeholders
    if ($records['info']['recordCount']) {                                // returns total record count in current page
        foreach ($records['data'] as $record) {                                // loop through records
            $_contents->setCurrentBlock('books');                            // set current block to "books" block
            $_contents->setVariable($record);                                // pass row array
            $_contents->parseCurrentBlock();                            // parse "books" block
        }
        for ($i=1; $i<=$records['info']['totalPages']; $i++) {                // iterate to number of pages
            $_contents->setCurrentBlock('paging');                            // set current block to "paging" block
            $_contents->setVariable('page', $i);                            // assigns page number to {page} placeholder
            if ($i == $records['info']['currentPage']) {                    // check if current page is the active page
                $_contents->setVariable ('page-active', 'page-active');       // attach "page-active" to current page's link
            }
            $_contents->parseCurrentBlock();                        // parse "paging" block
        }
    } else {
        $_contents->setVariable('empty', '');                                // parse "empty" block if no records found
    }

