<?php

function prova()  {
    return "hola";
}

function activacio() {
    //TODO
}

function desactivacio() {
    //TODO
}


add_shortcode("prova", "prova");

register_activation_hook(__FILE__, "activacio");
register_desactivation_hook(__FILE__, "desactivacio");