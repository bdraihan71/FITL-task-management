<!DOCTYPE html>
<html>
<head>
    <title>Task Assigned</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Task Assigned</h1>
            <p class="lead">Hello {{ $data['created_for_name'] }},</p>
            
            <p>A new task has been assigned to you:</p>
            
            <ul>
                <li><strong>Title:</strong> {{ $data['title'] }}</li>
                <li><strong>Description:</strong> {{ $data['description'] }}</li>
                <li><strong>Deadline:</strong> {{ $data['deadline'] }}</li>
            </ul>
            
            <p>Please log in to your account to view more details and manage your tasks.</p>
            
            <hr class="my-4">
            
            <p class="lead">Thank you!</p>
        </div>
    </div>
</body>
</html>
