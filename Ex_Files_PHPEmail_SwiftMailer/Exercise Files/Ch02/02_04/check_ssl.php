<?php
/*
 * To use an encrypted connection to an SMTP server, the
 * necessary OpenSSL transport wrappers must be enabled
 * on your web server. This file displays a complete list
 * of socket transports. Check that ssl and/or tls are listed.
 */
echo '<pre>';
print_r(stream_get_transports());
echo '</pre>';