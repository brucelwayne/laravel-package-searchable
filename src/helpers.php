<?php

if(!function_exists('strip_tags_to_searchable_text')){

    function strip_tags_to_searchable_text($html){
        $pattern = <<<'EOD'
~
(?:
    \G(?!\A)                 # second entry point
    (?:                        # content up to the next alt/title attribute (optional)
        [^><"]* "                 # end of the previous attribute
        (?> [^><"]* " [^"]* " )*? # other attributes (optional)
        [^><"]*                   # spaces or attributes without values (optional)
        \b(?:alt|title)\s*=\s*"   # the next alt/title attribute
    )?+                        # make all the group optional
  |
    <img\s[^>]*?             # first entry point
    \b(?:alt|title)\s*=\s*"
)
[^<"]*+\K
(?:              # two possibilities:
    </?a[^>]*>     # an "a" tag (opening or closing)
  |                # OR
    (?=")          # followed by the closing quote
)
~x
EOD;

        $result = preg_replace($pattern, '', $html);
        return strip_tags($result);
    }
}