<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Logs</title>
    <!-- 引入 Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Query Logs</h1>
    <form action="{{ route('query_logs.index') }}" method="GET" class="flex mb-4">
        <input type="text" name="search" placeholder="Search by SQL"
               class="border border-gray-300 rounded-l-md px-4 py-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Execute</button>
    </form>
    @if(!empty($queryLogs))
    <table class="min-w-full bg-white border border-gray-300 rounded-md overflow-hidden">
        <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">User</th>
            <th class="py-2 px-4 border-b">Time</th>
            <th class="py-2 px-4 border-b">SQL Statement</th>
            <th class="py-2 px-4 border-b">Error</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($queryLogs as $log)
            <tr>
                <td class="py-2 px-4 border-b">{{ $log->id }}</td>
                <td class="py-2 px-4 border-b">{{ $log->username }}</td>
                <td class="py-2 px-4 border-b">{{ $log->created_at }}</td>
                <td class="py-2 px-4 border-b">{{ $log->sql }}</td>
                <td class="py-2 px-4 border-b">{{ $log->error }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $queryLogs->appends(['search' => $search])->links() }}
    </div>
    <div class="flex justify-left space-x-4">
        <form action="{{ route('sqlQueryExportExcel') }}" method="get">
            <input type="hidden" name="search" value="{{ $search }}">
            <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Export Excel</button>
        </form>
        <form action="{{ route('sqlQueryExportJson') }}" method="get">
            <input type="hidden" name="search" value="{{ $search }}">
            <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Export Json</button>
        </form>
    </div>
    @endempty
</div>
</body>
</html>
