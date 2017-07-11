<?php
function XSSfilter($string) {
  return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}
?>