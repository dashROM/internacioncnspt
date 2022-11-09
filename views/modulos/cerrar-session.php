<?php

session_destroy();

echo '<script>

	localStorage.clear();

	window.location = "'.BASEURL.'/login";

</script>';	