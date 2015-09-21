<div id="rsvpContent" class="rsNoDrag col-md-8 col-md-offset-2">
    <div class="leftSide">
        <?php

        $content = do_shortcode("[rsvp]");
        // create the DOMDocument object, and load HTML from a string
        $replace = array('placeholder="First Name" name="firstName"','placeholder="Last Name" name="lastName"','placeholder="Phone Number" name="mainquestion1"','placeholder="Street Address" name="mainquestion2"','placeholder="City" name="mainquestion3"','placeholder="State" name="mainquestion4"','placeholder="Zip/Postal Code" name="mainquestion5"');
        $search = array('name="firstName"','name="lastName"','name="mainquestion1"','name="mainquestion2"','name="mainquestion3"','name="mainquestion4"','name="mainquestion5"');
        $content = str_replace($search,$replace,$content);


        // returns a string with the HTML content from a DOMDocument node element ($elm)

        function innerHTML(DOMNode $elm) {
            $innerHTML = '';
            $children  = $elm->childNodes;

            foreach($children as $child) {
                $innerHTML .= $elm->ownerDocument->saveHTML($child);
            }

            return $innerHTML;
        }

        function previousElementSibling( DOMNode $elm ) {

            $siblings = $elm->previousSibling;

            while ( $siblings && $siblings->nodeType !== 1 );
                return innerHTML($siblings);

        }

        $dom = new DOMDocument();
        @$dom->loadHTML($content);

        $inputs = $dom->getElementsByTagName('input');

        foreach($inputs as $input){
            $innerHTML = '';
            if ($input->hasAttributes()) {
                foreach ($input->attributes as $attr) {
                    $name = $attr->nodeName;
                    $value = $attr->nodeValue;
                    if (strpos($name, 'name') !== false ){
                        if (strpos($value, 'question') !== false){
                            $inputSibling = $input->previousSibling;
                            if (isset($inputSibling) && !empty($inputSibling)){
                                $cnt_dv2 = previousElementSibling($inputSibling);
                                $input->setAttribute("placeholder",$cnt_dv2);
                            }
                        }
                        elseif (strpos($value, 'Email') !== false){
                            $input->setAttribute("placeholder","Email Address");
                        }
                    }
                }
            }
        }

        if ($dom->saveHTML() !== null){
            echo $dom->saveHTML();
        }
        else {
            echo $content;
        }

        ?>
    </div>
</div>
