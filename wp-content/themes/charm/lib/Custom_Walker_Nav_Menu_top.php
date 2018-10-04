<?php

class Custom_Walker_Nav_Menu_top extends Walker_Nav_Menu
{
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $is_current_item = '';
        if(array_search('current-menu-item', $item->classes) != 0)
        {
            $is_current_item = ' class="active"';
        }
        echo '<li'.$is_current_item.'><a target="'.$item->target.'" href="'.$item->url.'">'.$item->title;
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        echo '</a></li>';
    }
}