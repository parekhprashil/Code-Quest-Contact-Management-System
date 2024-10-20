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

            <!-- Remember Me Checkbox -->
            <!-- <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>
                <div class="text-sm">
                    <a href="#" class="text-blue-600 hover:text-blue-500">Forgot your password?</a>
                </div>
            </div> -->

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
                <!-- <span class="px-2 bg-white text-gray-500">Or continue with</span> -->
            </div>
        </div>

        <!-- Social Login Options -->
        <!-- <div class="mt-6 grid grid-cols-3 gap-3">
            <div>
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <span class="sr-only">Sign in with Facebook</span> -->
                    <!-- Replace with Facebook Icon -->
                    <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597 0 1.324v21.351C0 23.403.597 24 1.324 24H12.82v-9.29H9.692v-3.622h3.129V8.413c0-3.1 1.894-4.786 4.66-4.786 1.325 0 2.463.099 2.794.142v3.24h-1.918c-1.503 0-1.794.713-1.794 1.76v2.31h3.586l-.467 3.622h-3.119V24h6.116c.728 0 1.324-.597 1.324-1.325V1.324C24 .597 23.403 0 22.675 0z"/></svg>
                </a>
            </div>
            <div> -->
                <!-- <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <span class="sr-only">Sign in with Google</span> -->
                    <!-- Replace with Google Icon -->
                    <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 48 48"><path d="M44.5 20H24v8.7h11.8C34.1 33.7 29.6 38 24 38c-6.4 0-11.6-5.2-11.6-11.6S17.6 14.8 24 14.8c2.9 0 5.4 1 7.4 2.7l6.2-6.2C34.1 7.6 29.4 6 24 6 13.5 6 5 14.5 5 25s8.5 19 19 19c10.5 0 19-8.5 19-19 0-1.3-.1-2.5-.3-3.7z"/></svg>
                </a>
            </div>
            <div> -->
                <!-- <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <span class="sr-only">Sign in with Twitter</span> -->
                    <!-- Replace with Twitter Icon -->
                    <!-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.933 4.933 0 0 0 2.165-2.724 9.864 9.864 0 0 1-3.127 1.195 4.918 4.918 0 0 0-8.384 4.482A13.94 13.94 0 0 1 1.67 3.149 4.917 4.917 0 0 0 3.194 9.86 4.904 4.904 0 0 1 .964 9.33v.061a4.917 4.917 0 0 0 3.946 4.827 4.902 4.902 0 0 1-2.224.085 4.92 4.92 0 0 0 4.597 3.417 9.868 9.868 0 0 1-6.1 2.105c-.397 0-.788-.023-1.175-.068a13.933 13.933 0 0 0 7.548 2.211c9.056 0 14.01-7.512 14.01-14.01 0-.213-.005-.425-.014-.637A10.012 10.012 0 0 0 24 4.557z"/></svg>
                </a>
            </div>
        </div> -->

        <!-- Sign-up Option -->
        <!-- <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Don't have an account? <a href="#" class="text-blue-600 hover:text-blue-500">Sign up</a></p>
        </div> -->
    </div>
</body>
</html>
