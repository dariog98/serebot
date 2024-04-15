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
                return "<b>Bold</b><br><i>Italic</i>\n<code>Monospace code</code>\n<u>Underline</u>";
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