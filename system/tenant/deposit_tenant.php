<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    $servername= "localhost";
    $username="root";
    $password="";
    $dbname="ktenant"; 

    $conn= mysqli_connect($servername,$username,$password,$dbname); 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

        
      session_start();
      $user_id = '';
      if( !isset($_SESSION["USER_ID"]) ){
          $user_id = $_SESSION["USER_ID"];
          header("Location:../../login.php");
          exit();
      }

      if(isset($_POST['ammount'])){
        $amount = $_POST['ammount'];
        if(isset($_FILES['file'])){
          echo "Hellos";
          $id = 0;
          while(true){
            $id = rand(0,999999);
            $query = mysqli_query($conn, "SELECT * FROM `cheque` WHERE `folder` = '$id'");
            if(mysqli_num_rows($query)== 0){
              break;
            }
          }
          echo "Niga";
          $isCreated = false;
          if(is_dir("../content/" . $id)){
            $isCreated= true;
          }
          else{
            if(mkdir("../content/" . $id)){
              $isCreated= true;
            }
          }
          if($isCreated !=false){
            echo "Hello";
            $name = $_FILES['file']['name'];
            $file = $_FILES['file']['tmp_name'];
            move_uploaded_file($file, "../content/" . $id . "/" . $name );
            mysqli_query($conn, "INSERT INTO `cheque`(`folder`, `name`, `user_id`) VALUE ('$id','$name','$user_id')");
          }
        }
        
      }

    ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;0,800;1,500&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
    .container2 {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card {
        width: 500px;
        height: 500px;
        background-color: var(--color-white);
        border-radius: var(--card-border-radius);
        padding: var(--card-padding);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: var(--box-shadow);
    }

    .card:hover {
        box-shadow: none;
        transform: scale(1.05);
    }

    .card:hover .card-icon {
        transform: scale(1.2);
    }

    .card-icon {
        font-size: 4rem;
        color: var(--color-primary);
        margin-bottom: 1rem;
        transition: transform 0.3s;
    }

    .card-label {
        font-size: 1.2rem;
        font-weight: 600;
    }

    /* Pop-up modal styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease;
    }

    .modal-content {
        width: 80vh;
        height: 80vh;
        background-color: var(--color-white);
        border-radius: var(--card-border-radius);
        padding: var(--card-padding);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .modal-label {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        cursor: pointer;
    }

    .show-modal {
        visibility: visible;
        opacity: 1;
    }

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: auto;
    }

    .submit-button {
        padding: 10px 20px;
        background-color: var(--color-primary);
        color: var(--color-white);
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #stripe-modal .modal-content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #stripe-modal h1 {
        margin-bottom: 1rem;
    }

    #stripe-modal label {
        display: block;
        margin-bottom: 0.5rem;
    }

    #stripe-modal #card-element {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    #stripe-modal #card-errors {
        color: red;
        margin-top: 0.5rem;
    }

    #stripe-modal #amount {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    #stripe-modal button[type="submit"] {
        padding: 10px 20px;
        background-color: var(--color-primary);
        color: var(--color-white);
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="number"] {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        outline: none;
    }
    </style>

    </style>
</head>

<div class="container">


    <?php 
         include 'Navigationbar.php';?>
    <main>
        <h1>Please Pick A deposit Method</h1>

        <body>
            <div class="container2">
                <div class="card" onclick="openModal('deposit')">
                    <i class="material-icons card-icon">account_balance</i>
                    <div class="card-label">Deposit Cheque</div>

                </div>
                <div class="card" onclick="openModal('stripe')">
                    <i class="material-icons card-icon">credit_card</i>
                    <div class="card-label">Stripe</div>
                </div>
            </div>

            <!-- Pop-up modals -->
            <div id="deposit-modal" class="modal">
                <div class="modal-content">
                    <span class="modal-close" onclick="closeModal('deposit')">&times;</span>
                    <div class="modal-label">Deposit Cheque Details</div>
                    <div>
                    </div>
                    <div>
                        <form action="" method="post" enctype="multipart/data">
                            <label for="check-image">Upload Check Image:</label>
                            <input type="file" id="check-image" accept="image/*">
                            <input type="number" name="ammount" id="">
                            <button class="submit-button">Submit</button>
                            <!-- <img id="check-image-preview" src="" alt="Check Image Preview"style="max-width: 90%; height: auto; margin-top: 10px; display: none;"> -->
                        </form>
                    </div>

                    <label for="check-example">Example:</label>
                    <!-- <img id="" src="deposit.png" alt="" style="max-width: 100%; height: auto; margin-top: 10px; "> -->
                    <!-- <button class="submit-button" onclick="submitDeposit()">Submit</button> -->

                </div>

            </div>
</div>
<div id="stripe-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal('stripe')">&times;</span>
        <form action="stripe.php" method="POST" id="payment-form">
            <h1>Stripe Card Payment</h1>
            <div>
                <img id="" src="card.png" alt="" style="max-width: 100%; height: auto; margin-top: 10px; ">
                <label for="card-element">
                    Credit or debit card
                </label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>

            <div>
                <label for="amount">Add Amount:</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" required>
            </div>

            <button type="submit">Pay</button>
        </form>
    </div>
</div>

<div id="success-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal('success')">&times;</span>
        <h2>Payment Successful!</h2>
        <p>Thank you for your payment.</p>
    </div>
</div>

</main>

<script>
const checkImageInput = document.getElementById('check-image');
const checkImagePreview = document.getElementById('check-image-preview');

checkImageInput.addEventListener('change', function() {
    const file = checkImageInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            checkImagePreview.src = e.target.result;
            checkImagePreview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        checkImagePreview.src = '';
        checkImagePreview.style.display = 'none';
    }
});
</script>
<script>
function openModal(paymentType) {
    const modal = document.getElementById(`${paymentType}-modal`);
    modal.classList.add('show-modal');
}

function closeModal(paymentType) {
    const modal = document.getElementById(`${paymentType}-modal`);
    modal.classList.remove('show-modal');
}

function navigateToPayment(paymentType) {
    // Add your navigation code here
    console.log(`Clicked on ${paymentType}`);

    // Open the corresponding modal
    openModal(paymentType);
}

// Function to open the success modal
function openSuccessModal() {
    openModal('success');
}
</script>
<script>
// Set your Stripe publishable key
var stripe = Stripe('pk_test_scMohyFxHpovb9BDkm21uvXa');

// Create an instance of Elements
var elements = stripe.elements();

// Create a card Element and mount it to the card-element div
var card = elements.create('card');
card.mount('#card-element');


card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
}
</script>

</body>

</html>