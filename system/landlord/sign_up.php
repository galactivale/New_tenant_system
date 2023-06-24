<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/sign_up.css">
        <title>Document</title>
    </head>
    <body>
        <section>
            <div class="box">
                <div class="box-heading">
                    <div class="box-heading-content">
                        <div class="box-title">
                            <p>Sign Up</p>
                        </div>
                        <div class="box-title-name">
                            <p>Create account for landlord</p>
                        </div>
                    </div>
                    <div class="box-logo">
                        <div class="box-logos">
                            <p>K</p>
                        </div>
                    </div>
                </div>
                <form action="auth.php" method="get">
                    <div class="content">
                        <div class="box-content">
                            <div class="box-name">
                                <p>Username</p>
                            </div>
                            <div class="box-subname">
                                <input type="text" name="username" id="username" >
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="box-name">
                                <p>Email</p>
                            </div>
                            <div class="box-subname">
                                <input type="email" name="email" id="email" >
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="box-name">
                                <p>Password</p>
                            </div>
                            <div class="box-subname">
                                <input type="text" name="password" id="password" >
                            </div>
                        </div>
                        <div class="box-flex">
                            <div class="box-content">
                                <div class="box-name">
                                    <p>First Name</p>
                                </div>
                                <div class="box-subname">
                                    <input type="text" name="name" id="name" >
                                </div>
                            </div>
                            <div class="box-content">
                                <div class="box-name">
                                    <p>Last Name</p>
                                </div>
                                <div class="box-subname">
                                    <input type="text" name="surname" id="surname" >
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <button>SignUp</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <script>
            function _(id){
                return document.getElementById(id);
            }
        </script>
    </body>
</html>