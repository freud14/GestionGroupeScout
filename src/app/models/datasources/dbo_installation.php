<?php

class DboInstallation extends DboSource {

    function connect() {
        $this->connected = true;
        return $this->connected;
    }

    function disconnect() {
        $this->connected = false;
        return !$this->connected;
    }

}

?>
