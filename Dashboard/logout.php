<?php
    session_start();
    session_destroy();

    echo "<script>aleart('คุณได้ทำการออกจากระบบเป็นที่เรียบร้อย');</script>";
    Header('Refresh:0 url=login.html');

?>
