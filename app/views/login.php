<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<div>
    <div>
        <div>
            <h2>Login</h2>
        </div>
        <div>
            <form method="post" action="/logic/login">
                <div>
                    <div>
                        <div>
                            <label for="email">Email</label>
                            <div>
                                <input id="email" name="email" type="email" placeholder="email">
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

                    </div>
                </div>
                <div>
                    <div>
                        <button type="submit">Login</button>
                    </div>
                    <div>
                        <a href="/register">Dont have account?</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>