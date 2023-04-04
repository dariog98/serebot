<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Serebot</title>

    <style>
        .w-20 {
            width: 20%;
        }

        .w-80 {
            width: 80%;
        }

        .my-8 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }

        .avatar {
            border-width: 0.25rem;
            border-style: solid;
            border-radius: 50%;
            width: 8rem;
            height: 8rem;
            background-color: #808080;
        }
    </style>
</head>
<body data-bs-theme="dark">
    <header class="mt-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <img class="avatar my-2" src="./assets/avatar.jpg">
            <h1 class="fw-bold">Serebot</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex gap-3">
                        <p class="text-center"><i class="fa-brands fa-telegram"></i> <a href="https://t.me/serenidad_bot">Serebot</a></p>
                        <p class="text-center"><i class="fa-brands fa-github"></i> <a href="https://github.com/dariog98/serebot">Source code</a></p>
                    </div>
                    <p class="text-center">Serebot is a minimalist Telegram bot</p>
                    <h5 class="text-center">Commands Availables</h5>

                    <div class="card"> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="w-20">Command</th>
                                    <th class="w-80">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>/toJSON</td>
                                    <td>Returns in JSON format the data of the replied message</td>
                                </tr>
                                <tr>
                                    <td>/commands</td>
                                    <td>Returns a message with the current list of commands</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">And more to come!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>