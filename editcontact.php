<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit;
}
include 'conf.php';

// Check if an ID is passed (e.g., via GET) to load the contact data for editing
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is an integer

    // Prepare the SQL statement
    $sql = "SELECT * FROM contactdetails WHERE id = ?";
    $stmt = $con->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        // Error handling: display the error
        die('Error in preparing statement: ' . $con->error);
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param('i', $id);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc(); // Store contact info in $contact variable
    } else {
        // If no contact found, you may want to redirect or show an error
        echo "Contact not found.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10">
        <!-- Form Container -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <?php echo isset($contact) ? "Edit Contact" : "Add New Contact"; ?>
            </h2>
            
            <!-- Contact Form -->
            <form id="contactForm" action="con_editcontact.php" method="POST" class="space-y-4">
                <!-- Hidden field to store the contact ID (for editing) -->
                <?php if (isset($contact)): ?>
                    <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                <?php endif; ?>

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        value="<?php echo isset($contact) ? $contact['contact_name'] : ''; ?>"
                        placeholder="Enter your name">
                </div>

                <!-- Contact Number Field -->
                <div>
                    <label for="contact" class="block text-gray-700 font-medium">Contact Number <span class="text-red-500">*</span></label>
                    <input type="tel" id="contact" name="contact" required 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        value="<?php echo isset($contact) ? $contact['contact_phone_number'] : ''; ?>"
                        placeholder="Enter your contact number" pattern="[0-9]+" title="Please enter numbers only">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email ID <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        value="<?php echo isset($contact) ? $contact['contact_email_id'] : ''; ?>"
                        placeholder="Enter your email">
                </div>

                <!-- Image URL Field (Optional) -->
                <div>
                    <label for="image" class="block text-gray-700 font-medium">Image URL (Optional)</label>
                    <input type="url" id="image" name="image" 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        value="<?php echo isset($contact) ? $contact['image_url'] : ''; ?>"
                        placeholder="Enter an image URL (optional)">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php echo isset($contact) ? 'Update Contact' : 'Submit'; ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
