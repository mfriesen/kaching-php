<?php
if (!empty($this->data)) {
  foreach ($this->data as $k => $v) {
    echo "<option value='$k'>$v</option>";
  }
}
?>