<?php

// add all event listeners here
Event::listen('ASM.*', 'ASM\Listeners\EmailNotifier');