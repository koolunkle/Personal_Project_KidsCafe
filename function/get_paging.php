<?php
// $write_pages (number of page exposures) > default : 10
// $current_page 
// $total_page
// 'PHP_EOL' = \n
function get_paging_opt1($write_pages, $current_page, $total_page, $url)
{
  // transform url : e.g. 'mode=send&page=123' > 'mode=send&page='
  $pattern = "'/&page=[0-9]*/'";
  $url = preg_replace($pattern, '', $url) . 'page=';

  // 0. start paging
  $str = '';

  // 1. from page 2, mark '<<' 
  ($current_page > 1) ? ($str .= '<a href="' . $url . '1"> <<< </a>' . PHP_EOL) : '';

  // 2. set start and end page
  $start_page = (((int) (($current_page - 1) / $write_pages)) * $write_pages) + 1;
  $end_page = $start_page + $write_pages - 1;
  if ($end_page >= $total_page)
    $end_page = $total_page;

  // 3. from page 11, mark '<-'
  if ($start_page > 1)
    $str .= '<a href="' . $url . ($start_page - 1) . '"> <- </a>' . PHP_EOL;

  // 4. if total page is more than page 2, register start and end page
  if ($total_page > 1) {
    for ($k = $start_page; $k <= $end_page; $k++) {
      if ($current_page != $k)
        $str .= '<a href="' . $url . $k . '">' . $k . '</a>' . PHP_EOL;
      else
        $str .= '<span style="color:blue;font-weight:bold">' . $k . '</span>' . PHP_EOL;
    }
  }

  // 5. if total page is greater than end page, mark '->'
  if ($total_page > $end_page)
    $str .= '<a href="' . $url . ($end_page + 1) . '"> -> </a>' . PHP_EOL;

  // 6. if current page is smaller than total page, mark '>>'
  if ($current_page < $total_page) {
    $str .= '<a href="' . $url . $total_page . '"> >>> </a>' . PHP_EOL;
  }

  // 7. register page
  if ($str)
    return "<li><span>{$str}</span></li>";
  else
    return "";
}

function get_paging_opt2($total_page, $page, $url)
{
  // if total page and current page is more than page 2 > move to previous page
  if ($total_page >= 2 && $page >= 2) {
    $new_page = $page - 1;
    echo "<li> <a href='$url?page=$new_page'>◀이전</a> </li>";
  } else
    echo "<li>&nbsp;</li>";

  // mark page link number (exposure start ~ end page)  
  for ($i = 1; $i <= $total_page; $i++) {
    if ($page == $i)
      // do not link current page number 
      echo "<li><b style='color:blue'> $i </b></li>";
    else
      // link other page number
      echo "<li> <a href='$url?page=$i'> $i </a> </li>";
  }

  //  if total page is more than page 2, current page is not end page > move to next page
  if ($total_page >= 2 && $page != $total_page) {
    $new_page = $page + 1;
    echo "<li> <a href='$url?page=$new_page'>다음▶</a> </li>";
  } else
    echo "<li>&nbsp;</li>";
}

function get_paging_opt3($total_page, $page, $mode, $url)
{
  if ($total_page >= 2 && $page >= 2) {
    $new_page = $page - 1;
    echo "<li> <a href='$url&page=$new_page'>◀ 이전</a> </li>";
  } else
    echo "<li>&nbsp;</li>";

  // mark page link number (exposure start ~ end page)  
  for ($i = 1; $i <= $total_page; $i++) {
    if ($page == $i)
      // do not link current page number 
      echo "<li><b style='color:blue'> $i </b></li>";
    else
      // link other page number
      echo "<li> <a href='$url&page=$i'> $i </a> <li>";
  }

  // if total page is more than page 2, current page is not end page > move to next page
  if ($total_page >= 2 && $page != $total_page) {
    $new_page = $page + 1;
    echo "<li> <a href='$url&page=$new_page'>다음 ▶</a> </li>";
  } else
    echo "<li>&nbsp;</li>";
}
?>