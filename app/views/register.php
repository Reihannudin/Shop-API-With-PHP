<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
<div>
    <div>
        <div>
            <h2>Register</h2>
        </div>
        <div>
            <form method="post" action="/logic/register">
                <div>
                    <div>
                        <div>
                            <label for="email">Email</label>
                            <div>
                                <input id="email" name="email" type="email" placeholder="email">
                            </div>
                        </div>
                        <div>
                            <label for="name">Username</label>
                            <div>
                                <input id="name" name="name" type="text" placeholder="name">
                            </div>
                        </div>
                    </div>
                    <div>

                        <div>
                            <label for="password">Password</label>
                            <div>
                                <input id="password" name="password" type="password" placeholder="password">
                            </div>
                        </div>
                        <div>
                            <label for="contact">Contact</label>
                            <div>
                                <input id="contact" name="contact" type="contact" placeholder="contact">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <button type="submit">Register</button>
                    </div>
                    <div>
                        <a href="/login">Already have account?</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
</body>
</html>