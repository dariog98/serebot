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
                return "
                    <h1>Title 1</h1>
                    <h2>Title 2</h2>
                    <h3>Title 3</h3>
                    <h4>Title 4</h4>
                    <p>Paragraph</p>
                    <b>Bold</b>
                    <i>Italic</i>
                    <code>Monospace code</code>
                    <q>Quote</q>
                    <button>Button</button>
                ";
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