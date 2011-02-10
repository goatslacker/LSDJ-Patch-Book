<?php

function hexinput_tag($name, $value = null, $options = array()) { // validates double: 00-FF
  return tag('input', array_merge(array('type' => 'text', 'name' => $name, 'id' => get_id_from_name($name, $value), 'value' => $value, 'onfocus' => 'this.title=this.value', 'onblur' => 'this.value=hex_check(this)'), _convert_options($options)));
}

function hex1input_tag($name, $value = null, $options = array()) { // validates all special ones.
  return tag('input', array_merge(array('type' => 'text', 'name' => $name, 'id' => get_id_from_name($name, $value), 'value' => $value, 'onfocus' => 'this.title=this.value', 'onblur' => 'this.value=special_hex_check(this)'), _convert_options($options)));
}

function link_to_feed($name, $uri)
{
  return link_to(image_tag('feed.png', array('alt' => 'RSS', 'title' => $name, 'align' => 'absmiddle')), $uri);
}

function pager_navigation($pager, $uri)
{
  $navigation = '';
 
  if ($pager->haveToPaginate())
  {  
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';
 
    // First and previous page
    if ($pager->getPage() != 1)
    {
	  $navigation .= link_to('&laquo;', '?page=1')."&nbsp;";
	  $navigation .= link_to('&lt;', $uri.$pager->getPreviousPage()) . "&nbsp;";

    }
 
    // Pages one by one
    $links = array();
    foreach ($pager->getLinks() as $page)
    {
      $links[] = link_to_unless($page == $pager->getPage(), $page, $uri.$page);
    }
    $navigation .= join('&nbsp;&nbsp;', $links);
 
    // Next and last page
    if ($pager->getPage() != $pager->getCurrentMaxLink())
    {
	  $navigation .= "&nbsp;". link_to('&raquo;', $uri.$pager->getLastPage());
	  $navigation .= "&nbsp;". link_to('&gt;', $uri.$pager->getNextPage());

    }
 
  }
 
  return $navigation;
}
