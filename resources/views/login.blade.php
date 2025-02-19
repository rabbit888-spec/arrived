<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>美观登录页 - Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-500 to-purple-500 flex justify-center items-center h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">登录</h1>
    <form id="loginFormTailwind" action="{{ route('login') }}">
        <div class="mb-4">
            <label for="usernameTailwind" class="block text-gray-700 font-medium mb-1">用户名</label>
            <input type="text" id="usernameTailwind" name="username" required value="admin"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-indigo-500">
        </div>
        <div class="mb-6">
            <label for="passwordTailwind" class="block text-gray-700 font-medium mb-1">密码</label>
            <input type="password" id="passwordTailwind" name="password" required value="123456"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:border-indigo-500">
        </div>
        <button type="submit"
                class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600 focus:outline-none">登录</button>
    </form>
</div>
</body>

</html>
