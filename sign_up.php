<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
      <li class="right"><a href="#">Dashboard</a></li>
      <li class="right"><a href="login.php">Login</a></li>
      <li class="right"><a href="#">Register</a></li>
    </ul>
  </nav>

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
      <form action="system/auth.php" method="get">
        <div class="content">
          <div class="box-content">
            <div class="box-name">
              <p>Username</p>
            </div>
            <div class="box-subname">
              <input type="text" name="username" id="username">
            </div>
          </div>
          <div class="box-content">
            <div class="box-name">
              <p>Email</p>
            </div>
            <div class="box-subname">
              <input type="email" name="email" id="email">
            </div>
          </div>
          <div class="box-content">
            <div class="box-name">
              <p>Password</p>
            </div>
            <div class="box-subname">
              <input type="password" name="password" id="password">
            </div>
          </div>
          <div class="box-flex">
            <div class="box-content">
              <div class="box-name">
                <p>First Name</p>
              </div>
              <div class="box-subname">
                <input type="text" name="name" id="name">
              </div>
            </div>
            <div class="box-content">
              <div class="box-name">
                <p>Last Name</p>
              </div>
              <div class="box-subname">
                <input type="text" name="surname" id="surname">
              </div>
            </div>
          </div>
          <div class="buttons">
            <button type="submit">Sign Up</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</body>
</html>
