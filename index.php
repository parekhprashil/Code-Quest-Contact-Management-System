<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
        <!-- Logo or Heading -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Cotact Mangmet System</h2>
            <p class="text-gray-500">Sign in to your account</p>
        </div>

        <!-- Login Form -->
        <form class="space-y-6" action="con_login.php" method="post">
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Enter your email">
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Enter your password">
            </div>

 

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Sign In
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="relative mt-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                
            </div>
        </div>

    </div>
</body>
</html>
