<?php

class Commands {
    private static function get_commands() {
        return [
            '/commands' => function ($message) {
                return "/toJSON -> Returns in JSON format the data of the replied message\n/commands -> Returns a message with the current list of commands";
            },
            '/toJSON' => function ($message) {
                return json_encode($message->get_reply_message()->get_data(), JSON_PRETTY_PRINT);
            },
            '/toHTML' => function ($message) {
                return `
                <b>bold</b>, <strong>bold</strong>
                <i>italic</i>, <em>italic</em>
                <u>underline</u>, <ins>underline</ins>
                <s>strikethrough</s>, <strike>strikethrough</strike>, <del>strikethrough</del>
                <span class="tg-spoiler">spoiler</span>, <tg-spoiler>spoiler</tg-spoiler>
                <b>bold <i>italic bold <s>italic bold strikethrough <span class="tg-spoiler">italic bold strikethrough spoiler</span></s> <u>underline italic bold</u></i> bold</b>
                <a href="http://www.example.com/">inline URL</a>
                <a href="tg://user?id=123456789">inline mention of a user</a>
                <tg-emoji emoji-id="5368324170671202286">👍</tg-emoji>
                <code>inline fixed-width code</code>
                <pre>pre-formatted fixed-width code block</pre>
                <pre><code class="language-python">pre-formatted fixed-width code block written in the Python programming language</code></pre>
                <blockquote>Block quotation started\nBlock quotation continued\nThe last line of the block quotation</blockquote>
                `;
            },
            '/resolve' => function ($message) {
                $text = $message->get_text();
                $words = explode(' ', $text);
        
                $op = array (
                    '+' => function($a, $b) {
                        return $a + $b;
                    },
                    '-' => function($a, $b) {
                        return $a - $b;
                    },
                    '*' => function($a, $b) {
                        return $a * $b;
                    },
                    '/' => function($a, $b) {
                        return $a / $b;
                    }
                );
        
                $result = ($op[$words[2]])
                ? $op[$words[2]](floatval($words[1]), floatval($words[3]))
                : sprintf('"%s" is not a valid operation', $words[2]);
        
                return $result;
            },
            'default' => function($message) {
                return "Please send a valid command\nUse /commands to see the list of available commands";
            }
        ];
    }

    public static function resolve($command, $message) {
        $commands = self::get_commands();
        
        $response = ($commands[$command])
        ? $commands[$command]($message)
        : $commands['default']($message);
        return $response;
    }
}

?>