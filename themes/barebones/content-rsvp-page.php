<div id="rsvpContent" class="rsNoDrag col-md-8 col-md-offset-2"><div class="leftSide"><?php

        $front_end_greeting = rsvp_frontend_greeting();

        $string = str_replace('name="firstName"','placeholder="Fist Name" name="firstName"',$front_end_greeting);
        $string = str_replace('name="lastName"','placeholder="Last Name" name="lastName"',$string);
        echo $string;


        ?></div></div>
