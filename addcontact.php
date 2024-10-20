<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Contact</h2>
            <form id="contactForm" action="con_addcontact.php" method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Enter your name">
                </div>

                <div>
                    <label for="contact" class="block text-gray-700 font-medium">Contact Number <span class="text-red-500">*</span></label>
                    <input type="tel" id="contact" name="contact" required 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Enter your contact number" pattern="[0-9]+" title="Please enter numbers only">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-medium">Email ID <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Enter your email">
                </div>
                <div>
                    <label for="image" class="block text-gray-700 font-medium">Image URL (Optional)</label>
                    <input type="url" id="image" name="image" 
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="Enter an image URL (optional)">
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
