<!DOCTYPE html>
<html>
<head>
    <title>Donation Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Make a Donation</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="process_donation.php" method="post">
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ngos">Select NGO:</label>
                        <select id="ngos" name="ngos" class="form-control" required>
                            <option value="">Select Desired NGO</option>
                            <option value="sonne">SONNE International</option>
                            <option value="care">Care</option>
                            <option value="fullmoon">Full Moon Foundation</option>
                            <option value="drishti">Drishti Foundation Trust</option>
                            <option value="smile">Smile Foundation</option>
                            <!-- Add more payment methods -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Donation Amount ($):</label>
                        <input type="number" id="amount" name="amount" class="form-control" min="1" step="1" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method:</label>
                        <select id="paymentMethod" name="paymentMethod" class="form-control" required>
                            <option value="">Select Payment Method</option>
                            <option value="creditCard">Credit Card</option>
                            <option value="paypal">PayPal</option>
                            <!-- Add more payment methods -->
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block">Donate Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
