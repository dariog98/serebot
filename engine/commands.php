<?php

class Commands {
    private static function get_commands() {
        return [
            '/commands' => function ($message) {
                return "/toJSON -> Returns in JSON format the data of the replied message\n/commands -> Returns a message with the current list of commands";
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