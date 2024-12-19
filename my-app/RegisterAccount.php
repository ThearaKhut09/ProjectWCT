<?php
if (isset($_POST['submit'])) {

  // Validation
  $errors = [];
  if (empty($_POST['fullName'])) {
      $errors['fullname'] = "Fullname is required";
  }

  if (empty($_POST['email'])) {
      $errors['email'] = "Email is required";
  }

  if (empty($_POST['password'])) {
      $errors['password'] = "Password is required";
  }

  if (empty($_POST['confirmPassword'])) {
    $errors['confirmPassword'] = "Confirmpassword is required";
  }

  // If no validation errors, proceed to insert the data
  if (empty($errors)) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Passwords do not match";
    }

    if (empty($errors)) {
        // Database connection
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPassword = 'Sophat343536';
        $dbName = 'user_db';

        // Create connection
        $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password for secure storage
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare an SQL statement using prepared statements
        $stmt = $conn->prepare("INSERT INTO customers (fullname, email, pass) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $hashedPassword);  // "sss" stands for 3 strings

        // Execute the statement
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">You have registered successfully!</div>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="custom-logo d-flex align-items-center">
                <span>ECHO</span>
                <span class="smile ms-1">BAY</span> 
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                 
                       <!-- Dropdown Menu -->
                       <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="bi bi-house"></i> Home
                        </a>
                    </li>
                    
                      
                        <li class="nav-item">
                            <a class="nav-link" href="viewproduc_all.html">
                                <i class="bi bi-box-seam me-1"></i> View Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="RegisterAccount.php">
                                <i class="bi bi-person-plus-fill me-1"></i> Sign Up
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Login.php">
                                <i class="bi bi-person-plus-fill me-1"></i> Login
                            </a>
                        </li>
                </ul>
                 
                </li>
            </div>
        </div>
    </nav>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg bg-dark text-white" style="width: 28rem;">
        <div class="card-body">
            <h1 class="card-title text-center mb-4 fw-bold fs-4 custom-title">
                <i class="bi bi-person-circle"></i> Register Account
            </h1>

            <!-- Display error message if any -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form id="signupForm" method="POST">
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" name="fullName" id="fullName" placeholder=" " required>
                    <label for="fullName" class="form-label">Full Name</label>
                </div>
                <div class="mb-3 position-relative">
                    <input type="email" class="form-control" name="email" id="email" placeholder=" " required>
                    <label for="email" class="form-label">Email Address</label>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder=" " required>
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="showPassword">
                    <label class="form-check-label" for="showPassword">Show Password</label>
                </div>
                <button type="submit" name="submit" class="btn w-100 btn-hover" style="background-color: #f39c12; color: white;">Register Account</button>
            </form>

            <div class="text-center mt-4">
                <p>
                    Already have an account? 
                    <a href="login.php" class="text-decoration-none custom-link">
                        <i class="bi bi-box-arrow-in-right"></i> Login here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-3">
              <h5>COMPANY NAME</h5>
              <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        
            <!-- Products -->
            <div class="col-md-3">
              <h5>PRODUCTS</h5>
              <ul class="list-unstyled">
                <li><a href="viewproduc_all.html">Detail Productioon</a></li>
                <li><a href="view_alldetail.html">Detail Item</a></li>
                <li><a href="Login.php">Login</a></li>
              </ul>
            </div>
        
            <!-- Useful Links -->
            <div class="col-md-3">
              <h5>USEFUL LINKS</h5>
              <ul class="list-unstyled">
                <li><a href="Login.php">Your Account</a></li>
                <li><a href="RegisterAccount.php">Signup</a></li>
                <li><a href="Login.php">Login</a></li>
              </ul>
            </div>
        
            <!-- Contact -->
            <div class="col-md-3">
              <h5>CONTACT</h5>
              <ul class="list-unstyled">
                <li><i class="bi bi-geo-alt-fill"></i> Phnom Penh, Ruessei Koev</li>
                <li><i class="bi bi-envelope-fill"></i> Chhunsophat@gmail.com</li>
                <li><i class="bi bi-telephone-fill"></i> +855 012618042</li>
                <li><i class="bi bi-telephone-fill"></i> +855 069820015</li>
              </ul>
              <div class="social-icons mt-3">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
              </div>
            </div>
          </div>
          <div class="text-center mt-4">
            <p>By <a href="#">Chhun Sophat</a></p>
          </div>
    </div>
  </footer>

<!-- Scripts -->
<script>
    // Show/Hide Password functionality
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    showPasswordCheckbox.addEventListener('change', () => {
        const type = showPasswordCheckbox.checked ? 'text' : 'password';
        passwordInput.type = type;
        confirmPasswordInput.type = type;
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
