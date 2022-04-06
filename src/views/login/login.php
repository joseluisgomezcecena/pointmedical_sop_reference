<style>
    .container-signin {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    height: 100vh;
  }
  
  .form-signin {
    width: 100%;
    max-width: 430px;
    padding: 15px;
    margin: auto;
  }
  
  .form-signin .checkbox {
    font-weight: 400;
  }
  
  .form-signin .form-floating:focus-within {
    z-index: 2;
  }
  
  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  
  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>



<div class="container-signin text-center">


<form class="form-signin" method="post">




    <div class="col-lg-12">
        <?php
        if (isset($login)) {
            if ($login->errors) {
                foreach ($login->errors as $error) {
                    echo '
           
                    <div class="alert alert-danger" role="alert">
                        <strong>Error!</strong>' . $error . '
                    </div>
             
            ';
                }
            }
            if ($login->messages) {
                foreach ($login->messages as $message) {
                    echo '
           
                    <div class="alert alert-warning" role="alert">
                        <strong>Error!</strong>' . $message . '
                    </div>
             
            ';                }
            }
        }
        ?>
    </div>




    <img class="mb-4" src="assets/img/logo.png" alt="">
    <h1 class="h5 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="user_name" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">User Name or Email</label>
    </div>
    <br>
    <div class="form-floating">
      <input type="password" class="form-control" name="user_password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-success" name="login" type="submit">Sign in</button>
  </form>
</div>
